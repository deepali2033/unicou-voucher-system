<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add user_id to services (avoid FK to prevent duplicate constraint issues on some MySQL/MariaDB setups)
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id')->index();
            }
        });

        // Add user_id and image to job_listings (avoid FK for now)
        Schema::table('job_listings', function (Blueprint $table) {
            if (!Schema::hasColumn('job_listings', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id')->index();
            }
            if (!Schema::hasColumn('job_listings', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });

        Schema::table('job_listings', function (Blueprint $table) {
            if (Schema::hasColumn('job_listings', 'user_id')) {
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('job_listings', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
