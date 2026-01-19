<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'profile_verification_status')) {
                $table->enum('profile_verification_status', ['pending', 'verified', 'rejected'])->default('pending')->after('account_type');
            }
            if (!Schema::hasColumn('users', 'aadhaar_number')) {
                $table->string('aadhaar_number')->nullable()->after('profile_verification_status');
            }
            if (!Schema::hasColumn('users', 'aadhaar_document_path')) {
                $table->string('aadhaar_document_path')->nullable()->after('aadhaar_number');
            }
            if (!Schema::hasColumn('users', 'verification_documents')) {
                $table->json('verification_documents')->nullable()->after('aadhaar_document_path');
            }
            if (!Schema::hasColumn('users', 'verification_notes')) {
                $table->text('verification_notes')->nullable()->after('verification_documents');
            }
            if (!Schema::hasColumn('users', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('verification_notes');
            }
            if (!Schema::hasColumn('users', 'verified_by')) {
                $table->foreignId('verified_by')->nullable()->constrained('users')->after('verified_at');
            }
            if (!Schema::hasColumn('users', 'profile_updated_at')) {
                $table->timestamp('profile_updated_at')->nullable()->after('verified_by');
            }
            if (!Schema::hasColumn('users', 'pending_profile_data')) {
                $table->json('pending_profile_data')->nullable()->after('profile_updated_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'profile_verification_status',
                'aadhaar_number',
                'aadhaar_document_path',
                'verification_documents',
                'verification_notes',
                'verified_at',
                'verified_by',
                'profile_updated_at',
                'pending_profile_data'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
