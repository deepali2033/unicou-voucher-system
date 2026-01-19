<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $connection = config('database.default');
        $driver = config("database.connections.$connection.driver");

        if ($driver === 'mysql') {
            try {
                $dbName = DB::getDatabaseName();
                $col = DB::table('information_schema.COLUMNS')
                    ->select('DATA_TYPE', 'COLUMN_TYPE')
                    ->where('TABLE_SCHEMA', $dbName)
                    ->where('TABLE_NAME', 'users')
                    ->where('COLUMN_NAME', 'account_type')
                    ->first();

                if ($col && $col->DATA_TYPE === 'enum') {
                    $columnType = $col->COLUMN_TYPE; // e.g. enum('user','recruiter')
                    $hasUser = str_contains($columnType, "'user'");
                    $hasRecruiter = str_contains($columnType, "'recruiter'");
                    $hasFreelancer = str_contains($columnType, "'freelancer'");

                    // Build a new enum set preserving existing ones and adding freelancer
                    $values = [];
                    if ($hasUser) $values[] = 'user'; else $values[] = 'user';
                    if ($hasRecruiter) $values[] = 'recruiter'; else $values[] = 'recruiter';
                    if (! $hasFreelancer) $values[] = 'freelancer'; else $values[] = 'freelancer';

                    $enumSql = "'" . implode("','", $values) . "'";
                    DB::statement("ALTER TABLE `users` MODIFY `account_type` ENUM($enumSql) NOT NULL DEFAULT 'user'");
                    return;
                }
            } catch (\Throwable $e) {
                // Non-fatal; ignore and fall through
            }
        }
        // For non-MySQL or non-enum columns (e.g., string), nothing to do.
    }

    public function down(): void
    {
        $connection = config('database.default');
        $driver = config("database.connections.$connection.driver");

        if ($driver === 'mysql') {
            try {
                $dbName = DB::getDatabaseName();
                $col = DB::table('information_schema.COLUMNS')
                    ->select('DATA_TYPE', 'COLUMN_TYPE')
                    ->where('TABLE_SCHEMA', $dbName)
                    ->where('TABLE_NAME', 'users')
                    ->where('COLUMN_NAME', 'account_type')
                    ->first();

                if ($col && $col->DATA_TYPE === 'enum') {
                    // Revert by removing freelancer from enum if present
                    DB::statement("ALTER TABLE `users` MODIFY `account_type` ENUM('user','recruiter') NOT NULL DEFAULT 'user'");
                    return;
                }
            } catch (\Throwable $e) {
                // Ignore
            }
        }
        // For non-MySQL or non-enum, nothing to revert.
    }
};