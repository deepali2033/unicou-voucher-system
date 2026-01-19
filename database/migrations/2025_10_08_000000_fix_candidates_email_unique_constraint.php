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
                    // Drop the unique constraint on email field
                    $table->dropUnique(['email']);
                });
            }
        } catch (\Exception $e) {
            // Index may not exist, that's fine
        }

        // Check if the compound unique constraint already exists
        try {
            $compoundIndexExists = DB::select("SHOW INDEX FROM candidates WHERE Key_name = 'candidates_user_job_unique'");

            if (empty($compoundIndexExists)) {
                Schema::table('candidates', function (Blueprint $table) {
                    // Add a compound unique constraint on user_id and job_listing_id
                    // This ensures one candidate record per user per job application
                    $table->unique(['user_id', 'job_listing_id'], 'candidates_user_job_unique');
                });
            }
        } catch (\Exception $e) {
            // Column may not exist, that's fine
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the compound unique constraint
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropUnique('candidates_user_job_unique');
        });

        // Re-add the unique constraint on email
        Schema::table('candidates', function (Blueprint $table) {
            $table->unique('email');
        });
    }
};
