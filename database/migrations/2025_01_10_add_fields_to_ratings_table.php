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
        Schema::table('ratings', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('ratings', 'rating_type')) {
                $table->string('rating_type')->nullable()->after('ratee_id');
            }
            if (!Schema::hasColumn('ratings', 'review_title')) {
                $table->string('review_title')->nullable()->after('review_text');
            }
            if (!Schema::hasColumn('ratings', 'experience_date')) {
                $table->date('experience_date')->nullable()->after('review_title');
            }
            if (!Schema::hasColumn('ratings', 'ip_address')) {
                $table->string('ip_address')->nullable()->after('experience_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            if (Schema::hasColumn('ratings', 'rating_type')) {
                $table->dropColumn('rating_type');
            }
            if (Schema::hasColumn('ratings', 'review_title')) {
                $table->dropColumn('review_title');
            }
            if (Schema::hasColumn('ratings', 'experience_date')) {
                $table->dropColumn('experience_date');
            }
            if (Schema::hasColumn('ratings', 'ip_address')) {
                $table->dropColumn('ip_address');
            }
        });
    }
};