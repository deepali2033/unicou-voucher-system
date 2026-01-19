<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update any existing data to match new enum values
        DB::table('candidates')->where('status', 'reviewing')->update(['status' => 'under_review']);
        DB::table('candidates')->where('status', 'hired')->update(['status' => 'accepted']);
        
        // Modify the enum column
        DB::statement("ALTER TABLE candidates MODIFY COLUMN status ENUM('pending', 'under_review', 'interviewed', 'accepted', 'rejected') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert data changes
        DB::table('candidates')->where('status', 'under_review')->update(['status' => 'reviewing']);
        DB::table('candidates')->where('status', 'accepted')->update(['status' => 'hired']);
        
        // Revert the enum column
        DB::statement("ALTER TABLE candidates MODIFY COLUMN status ENUM('pending', 'reviewing', 'interviewed', 'hired', 'rejected') DEFAULT 'pending'");
    }
};