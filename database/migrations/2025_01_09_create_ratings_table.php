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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rater_id')->comment('User who is rating');
            $table->unsignedBigInteger('ratee_id')->comment('User being rated');
            $table->unsignedTinyInteger('stars')->comment('1-5 star rating');
            $table->longText('review_text')->nullable()->comment('Written review');
            $table->unsignedBigInteger('job_id')->nullable()->comment('Associated job ID');
            $table->unsignedBigInteger('booking_id')->nullable()->comment('Associated booking ID');
            $table->timestamps();

            // Foreign keys
            $table->foreign('rater_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ratee_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('rater_id');
            $table->index('ratee_id');
            $table->index('job_id');
            $table->index('booking_id');

            // Constraints
            $table->unique(['rater_id', 'ratee_id'], 'unique_rating_per_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};