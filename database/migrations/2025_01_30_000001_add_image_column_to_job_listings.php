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
        Schema::table('job_listings', function (Blueprint $table) {
            // Add the correct 'image' column if it doesn't exist
            if (!Schema::hasColumn('job_listings', 'image')) {
                $table->string('image')->nullable()->after('meta_description');
            }
        });

        // Copy data from Image_url to image if Image_url exists and has data
        if (Schema::hasColumn('job_listings', 'Image_url')) {
            DB::statement('UPDATE job_listings SET image = Image_url WHERE Image_url IS NOT NULL AND Image_url != ""');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            if (Schema::hasColumn('job_listings', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
