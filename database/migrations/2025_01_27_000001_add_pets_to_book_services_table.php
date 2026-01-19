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
        if (Schema::hasTable('book_services') && !Schema::hasColumn('book_services', 'pets')) {
            Schema::table('book_services', function (Blueprint $table) {
                $table->string('pets')->nullable()->after('entrance_info');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('book_services', 'pets')) {
            Schema::table('book_services', function (Blueprint $table) {
                $table->dropColumn('pets');
            });
        }
    }
};
