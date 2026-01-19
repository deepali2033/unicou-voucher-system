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
        if (Schema::hasTable('book_services')) {
            Schema::table('book_services', function (Blueprint $table) {
                // Add missing columns if they don't exist
                if (!Schema::hasColumn('book_services', 'duration')) {
                    $table->string('duration')->nullable()->comment('Service duration (3-7 hours)');
                }
                
                if (!Schema::hasColumn('book_services', 'pets')) {
                    $table->string('pets')->nullable()->comment('Yes/No - Do they have pets');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('book_services')) {
            Schema::table('book_services', function (Blueprint $table) {
                $table->dropColumn(['duration', 'pets']);
            });
        }
    }
};