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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->date('dob');
            $table->string('id_document_type');
            $table->string('id_document_no');
            $table->string('contact_no');
            $table->string('email');
            $table->text('detail_address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('post_code');
            $table->string('whatsapp_no');
            $table->string('id_document_path')->nullable();
            $table->enum('purpose_of_exam', ['Education', 'Migration', 'Other']);
            $table->string('highest_education');
            $table->string('passing_year');
            $table->json('preferred_countries')->nullable();
            
            // Bank details
            $table->string('bank_name')->nullable();
            $table->text('bank_address')->nullable();
            $table->string('bank_account_no')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
