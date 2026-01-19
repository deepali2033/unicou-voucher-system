<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Best-effort: if MySQL and column is ENUM, expand enum to include recruiter, migrate values, then drop vendor
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
                    $columnType = $col->COLUMN_TYPE; // e.g. enum('user','vendor')
                    $hasVendor = str_contains($columnType, "'vendor'");
                    $hasRecruiter = str_contains($columnType, "'recruiter'");

                    // Ensure recruiter is allowed before updating values
                    if ($hasVendor && ! $hasRecruiter) {
                        DB::statement("ALTER TABLE `users` MODIFY `account_type` ENUM('user','vendor','recruiter') NOT NULL DEFAULT 'user'");
                    }

                    // Migrate values from vendor -> recruiter
                    DB::table('users')->where('account_type', 'vendor')->update(['account_type' => 'recruiter']);

                    // Now drop vendor from enum if it exists
                    if ($hasVendor) {
                        DB::statement("ALTER TABLE `users` MODIFY `account_type` ENUM('user','recruiter') NOT NULL DEFAULT 'user'");
                    }

                    return; // Done for MySQL enum
                }
            } catch (\Throwable $e) {
                // Fallback to simple UPDATE below
            }
        }

        // Fallback: for non-MySQL or string column types, just update data values
        DB::table('users')->where('account_type', 'vendor')->update(['account_type' => 'recruiter']);
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
                    $columnType = $col->COLUMN_TYPE;
                    $hasRecruiter = str_contains($columnType, "'recruiter'");
                    $hasVendor = str_contains($columnType, "'vendor'");

                    // Ensure vendor allowed
                    if (! $hasVendor) {
                        DB::statement("ALTER TABLE `users` MODIFY `account_type` ENUM('user','vendor','recruiter') NOT NULL DEFAULT 'user'");
                    }

                    // Revert values recruiter -> vendor
                    DB::table('users')->where('account_type', 'recruiter')->update(['account_type' => 'vendor']);

                    // Optionally drop recruiter to restore original shape
                    DB::statement("ALTER TABLE `users` MODIFY `account_type` ENUM('user','vendor') NOT NULL DEFAULT 'user'");

                    return;
                }
            } catch (\Throwable $e) {
                // Fallback below
            }
        }

        // Fallback: just revert values
        DB::table('users')->where('account_type', 'recruiter')->update(['account_type' => 'vendor']);
    }
};