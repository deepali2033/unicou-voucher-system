<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the unique constraint exists before dropping it
        try {
            $indexExists = DB::select("SHOW INDEX FROM candidates WHERE Key_name = 'candidates_email_unique'");

            if (!empty($indexExists)) {
                Schema::table('candidates', function (Blueprint $table) {
                    // Drop the unique index from email column
                    $table->dropUnique(['email']);
                });
            }
        } catch (\Exception $e) {
            // Index may not exist, that's fine
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            // Re-add the unique constraint if rolling back
            $table->unique('email');
        });
    }
};
