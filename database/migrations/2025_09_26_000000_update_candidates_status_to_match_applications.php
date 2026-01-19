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
        // Update existing data to match new enum values
        DB::table('candidates')->where('status', 'interviewed')->update(['status' => 'interview_scheduled']);
        DB::table('candidates')->where('status', 'accepted')->update(['status' => 'selected']);

        // Modify the enum column to match job_applications statuses
        DB::statement("ALTER TABLE candidates MODIFY COLUMN status ENUM('pending', 'under_review', 'interview_scheduled', 'selected', 'rejected') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert data changes
        DB::table('candidates')->where('status', 'interview_scheduled')->update(['status' => 'interviewed']);
        DB::table('candidates')->where('status', 'selected')->update(['status' => 'accepted']);

        // Revert the enum column
        DB::statement("ALTER TABLE candidates MODIFY COLUMN status ENUM('pending', 'under_review', 'interviewed', 'accepted', 'rejected') DEFAULT 'pending'");
    }
};
