<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade');
            $table->foreignId('job_listing_id')->constrained('job_listings')->onDelete('cascade');
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'under_review', 'interview_scheduled', 'accepted', 'rejected'])->default('pending');
            $table->boolean('recruiter_notified')->default(false);
            $table->boolean('admin_notified')->default(false);
            $table->timestamp('recruiter_notified_at')->nullable();
            $table->timestamp('admin_notified_at')->nullable();
            $table->text('application_notes')->nullable();
            $table->timestamps();

            // Ensure one application per freelancer per job
            $table->unique(['freelancer_id', 'job_listing_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
