<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            // Make recruiter_id nullable and rename conceptually to job_creator_id
            // but keep the field name for backward compatibility
            $table->foreignId('recruiter_id')->nullable()->change();

            // Update status enum to match requirements
            DB::statement("ALTER TABLE job_applications MODIFY COLUMN status ENUM('pending', 'under_review', 'interview_scheduled', 'selected', 'rejected') DEFAULT 'pending'");
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->foreignId('recruiter_id')->nullable(false)->change();

            DB::statement("ALTER TABLE job_applications MODIFY COLUMN status ENUM('pending', 'under_review', 'interview_scheduled', 'accepted', 'rejected') DEFAULT 'pending'");
        });
    }
};
