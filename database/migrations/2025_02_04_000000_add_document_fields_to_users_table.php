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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'resume')) {
                $table->string('resume')->nullable()->after('certifications');
            }
            if (!Schema::hasColumn('users', 'cover_letter')) {
                $table->string('cover_letter')->nullable()->after('resume');
            }
            if (!Schema::hasColumn('users', 'aadhar_card')) {
                $table->string('aadhar_card')->nullable()->after('cover_letter');
            }
            if (!Schema::hasColumn('users', 'pan_card')) {
                $table->string('pan_card')->nullable()->after('aadhar_card');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];
            foreach (['resume', 'cover_letter', 'aadhar_card', 'pan_card'] as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $columns[] = $col;
                }
            }
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
