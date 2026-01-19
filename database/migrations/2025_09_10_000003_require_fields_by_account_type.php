<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // No schema changes; validation is enforced at app level.
        // This migration exists to keep a record of the business rule change to include 'freelancer'.
    }

    public function down(): void
    {
        // No-op
    }
};