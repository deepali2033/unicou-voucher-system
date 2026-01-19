<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// One-off command to copy data from the old SQLite file into MySQL
Artisan::command('db:copy-sqlite-to-mysql', function () {
    $this->info('Preparing connections...');

    // Ensure the sqlite connection points to the old file regardless of current .env
    $sqlitePath = database_path('database.sqlite');
    if (!file_exists($sqlitePath)) {
        $this->error("SQLite database file not found at: {$sqlitePath}");
        return 1;
    }
    config(['database.connections.sqlite.database' => $sqlitePath]);

    // Test connections
    try {
        DB::connection('sqlite')->getPdo();
    } catch (\Throwable $e) {
        $this->error('Failed to connect to SQLite: ' . $e->getMessage());
        return 1;
    }

    try {
        DB::connection('mysql')->getPdo();
    } catch (\Throwable $e) {
        $this->error('Failed to connect to MySQL: ' . $e->getMessage());
        return 1;
    }

    $this->info('Running migrations on MySQL...');
    try {
        Artisan::call('migrate', ['--force' => true]);
        $this->line(Artisan::output());
    } catch (\Throwable $e) {
        $this->error('Migrate failed: ' . $e->getMessage());
        return 1;
    }

    // Get list of tables from SQLite (skip internal tables)
    $tables = collect(DB::connection('sqlite')->select("SELECT name FROM sqlite_master WHERE type='table'"))
        ->pluck('name')
        ->reject(function ($name) {
            return in_array($name, ['migrations', 'sqlite_sequence']);
        })
        ->values();

    if ($tables->isEmpty()) {
        $this->warn('No tables found in SQLite to copy.');
        return 0;
    }

    $this->info('Disabling MySQL foreign key checks...');
    DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=0');

    foreach ($tables as $table) {
        if (!Schema::connection('mysql')->hasTable($table)) {
            $this->warn("Skipping table '{$table}' (does not exist in MySQL).");
            continue;
        }

        $this->info("Copying table: {$table}");

        // Truncate destination table
        try {
            DB::connection('mysql')->table($table)->truncate();
        } catch (\Throwable $e) {
            $this->warn("Could not truncate '{$table}': {$e->getMessage()} - attempting delete instead");
            DB::connection('mysql')->table($table)->delete();
        }

        // Stream rows in chunks to avoid memory issues
        $count = 0;
        DB::connection('sqlite')->table($table)->orderBy('rowid')->chunk(1000, function ($rows) use ($table, &$count) {
            // Convert to array of associative arrays
            $payload = array_map(function ($row) {
                return (array) $row; // cast stdClass to array
            }, $rows->all());

            if (!empty($payload)) {
                DB::connection('mysql')->table($table)->insert($payload);
                $count += count($payload);
            }
        });

        $this->info("Copied {$count} rows into '{$table}'.");
    }

    $this->info('Re-enabling MySQL foreign key checks...');
    DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=1');

    $this->info('Data copy complete.');

    return 0;
})->purpose('Copy all data from SQLite database file into the current MySQL database');

// Command to migrate data from koa database to koa_services database
Artisan::command('migrate:koa-data {--force : Skip confirmation prompts}', function () {
    $this->info('Starting data migration from koa database to koa_services database...');

    if (!$this->option('force')) {
        if (!$this->confirm('This will replace all data in koa_services.users and add missing records to koa_services.migrations. Do you want to continue?')) {
            $this->info('Migration cancelled.');
            return 0;
        }
    }

    try {
        // Create connection to source database (koa)
        config(['database.connections.koa' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'koa',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]]);

        // Test connection to koa database
        $this->info('Testing connection to koa database...');
        $koaConnection = DB::connection('koa');
        $koaConnection->getPdo();
        $this->info('✓ Connection to koa database successful');

        // Test connection to koa_services database (default)
        $this->info('Testing connection to koa_services database...');
        $koaServicesConnection = DB::connection();
        $koaServicesConnection->getPdo();
        $this->info('✓ Connection to koa_services database successful');

        // Check if tables exist in source database
        if (!Schema::connection('koa')->hasTable('users')) {
            $this->error('Table "users" does not exist in koa database');
            return 1;
        }

        if (!Schema::connection('koa')->hasTable('migrations')) {
            $this->error('Table "migrations" does not exist in koa database');
            return 1;
        }

        // Check if tables exist in destination database
        if (!Schema::hasTable('users')) {
            $this->error('Table "users" does not exist in koa_services database');
            return 1;
        }

        if (!Schema::hasTable('migrations')) {
            $this->error('Table "migrations" does not exist in koa_services database');
            return 1;
        }

        // Migrate users data (replace all)
        $this->info('Migrating users data...');

        // Get all users from source database
        $users = $koaConnection->table('users')->get();
        $userCount = $users->count();

        if ($userCount === 0) {
            $this->warn('No users found in source database');
        } else {
            $this->info("Found {$userCount} users in source database");

            // Get the structure of both tables to ensure compatibility
            $sourceColumns = Schema::connection('koa')->getColumnListing('users');
            $destColumns = Schema::getColumnListing('users');

            $this->info('Source table columns: ' . implode(', ', $sourceColumns));
            $this->info('Destination table columns: ' . implode(', ', $destColumns));

            // Find common columns
            $commonColumns = array_intersect($sourceColumns, $destColumns);
            $this->info('Common columns: ' . implode(', ', $commonColumns));

            if (empty($commonColumns)) {
                $this->error('No common columns found between source and destination users tables');
                return 1;
            }

            // Clear existing users data
            $this->info('Clearing existing users data...');
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('users')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // Insert users in batches
            $batchSize = 100;
            $batches = $users->chunk($batchSize);
            $insertedCount = 0;

            foreach ($batches as $batch) {
                $batchData = [];
                foreach ($batch as $user) {
                    $userData = [];
                    foreach ($commonColumns as $column) {
                        $userData[$column] = $user->$column;
                    }
                    $batchData[] = $userData;
                }

                DB::table('users')->insert($batchData);
                $insertedCount += count($batchData);
                $this->info("Inserted batch: {$insertedCount}/{$userCount} users");
            }

            $this->info("✓ Successfully migrated {$insertedCount} users");
        }

        // Migrate migrations data (insert missing only)
        $this->info('Migrating migrations data...');

        // Get all migrations from source database
        $sourceMigrations = $koaConnection->table('migrations')->get();
        $sourceCount = $sourceMigrations->count();

        if ($sourceCount === 0) {
            $this->warn('No migrations found in source database');
        } else {
            $this->info("Found {$sourceCount} migrations in source database");

            // Get existing migrations from destination database
            $existingMigrations = DB::table('migrations')->pluck('migration')->toArray();
            $this->info("Found " . count($existingMigrations) . " existing migrations in destination database");

            // Get table columns
            $sourceColumns = Schema::connection('koa')->getColumnListing('migrations');
            $destColumns = Schema::getColumnListing('migrations');
            $commonColumns = array_intersect($sourceColumns, $destColumns);

            if (empty($commonColumns)) {
                $this->error('No common columns found between source and destination migrations tables');
                return 1;
            }

            // Filter out migrations that already exist
            $newMigrations = $sourceMigrations->filter(function ($migration) use ($existingMigrations) {
                return !in_array($migration->migration, $existingMigrations);
            });

            $newCount = $newMigrations->count();

            if ($newCount === 0) {
                $this->info('No new migrations to insert - all migrations already exist in destination database');
            } else {
                $this->info("Found {$newCount} new migrations to insert");

                // Insert new migrations
                $insertedCount = 0;
                foreach ($newMigrations as $migration) {
                    $migrationData = [];
                    foreach ($commonColumns as $column) {
                        // Skip the ID column since it's auto-increment
                        if ($column !== 'id') {
                            $migrationData[$column] = $migration->$column;
                        }
                    }

                    DB::table('migrations')->insert($migrationData);
                    $insertedCount++;
                    $this->info("Inserted migration: {$migration->migration}");
                }

                $this->info("✓ Successfully inserted {$insertedCount} new migrations");
            }
        }

        $this->info('Data migration completed successfully!');
        return 0;

    } catch (\Exception $e) {
        $this->error('Error during migration: ' . $e->getMessage());
        return 1;
    }
})->purpose('Migrate users and migrations data from koa database to koa_services database');
