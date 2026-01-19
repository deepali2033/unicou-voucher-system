<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JobListing;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Approve all existing unapproved job listings
        // This is a one-time fix for the bug where freelancer jobs weren't being auto-approved
        JobListing::where('is_approved', false)
            ->update(['is_approved' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't reverse this change as it would break existing functionality
        // and hide jobs that should be visible
    }
};
