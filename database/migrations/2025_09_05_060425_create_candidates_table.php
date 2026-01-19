<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            $table->string('position_applied')->nullable();
            $table->enum('employment_type_preference', ['full-time', 'part-time', 'contract', 'temporary'])->nullable();
            $table->decimal('expected_salary_min', 10, 2)->nullable();
            $table->decimal('expected_salary_max', 10, 2)->nullable();
            $table->string('expected_salary_type')->default('hourly'); // hourly, monthly, yearly
            $table->date('available_start_date')->nullable();
            $table->text('work_experience')->nullable();
            $table->text('education')->nullable();
            $table->json('skills')->nullable(); // Array of skills
            $table->text('certifications')->nullable();
            $table->string('resume_path')->nullable(); // Path to uploaded resume
            $table->string('cover_letter_path')->nullable(); // Path to uploaded cover letter
            $table->text('additional_notes')->nullable();
            $table->enum('status', ['pending', 'reviewing', 'interviewed', 'hired', 'rejected'])->default('pending');
            $table->boolean('is_active')->default(true);
            $table->timestamp('applied_at')->useCurrent();
            $table->foreignId('job_listing_id')->nullable()->constrained()->onDelete('set null');
            $table->string('referral_source')->nullable(); // How they heard about the job
            $table->boolean('willing_to_relocate')->default(false);
            $table->boolean('has_transportation')->default(true);
            $table->boolean('background_check_consent')->default(false);
            $table->timestamps();
            
            $table->index(['status', 'is_active']);
            $table->index(['position_applied', 'status']);
            $table->index('applied_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
