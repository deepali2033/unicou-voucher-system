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
        // Update existing data to use 'selected' instead of 'accepted'
        DB::table('job_applications')->where('status', 'accepted')->update(['status' => 'selected']);

        // Modify the enum column to include 'selected'
        DB::statement("ALTER TABLE job_applications MODIFY COLUMN status ENUM('pending', 'under_review', 'interview_scheduled', 'selected', 'rejected') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert data changes
        DB::table('job_applications')->where('status', 'selected')->update(['status' => 'accepted']);

        // Revert the enum column
        DB::statement("ALTER TABLE job_applications MODIFY COLUMN status ENUM('pending', 'under_review', 'interview_scheduled', 'accepted', 'rejected') DEFAULT 'pending'");
    }
};
