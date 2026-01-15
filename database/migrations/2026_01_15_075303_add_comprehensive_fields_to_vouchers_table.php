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
        Schema::table('vouchers', function (Blueprint $table) {
            $table->string('type')->default('discount')->comment('discount, fixed_amount, free_item');
            $table->decimal('discount_percent', 5, 2)->nullable()->default(0);
            $table->decimal('fixed_amount', 10, 2)->nullable();
            $table->string('free_item_name')->nullable();
            $table->integer('per_user_limit')->nullable();
            $table->integer('total_limit')->nullable();
            $table->json('applicable_user_types')->nullable()->comment('JSON array of user types: student, agent, reseller, etc.');
            $table->enum('extended_status', ['active', 'inactive', 'frozen'])->default('active');
            $table->boolean('is_system_paused')->default(false);
            $table->timestamp('last_modified_by')->nullable();
            $table->timestamp('last_freeze_unfreeze_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'discount_percent',
                'fixed_amount',
                'free_item_name',
                'per_user_limit',
                'total_limit',
                'applicable_user_types',
                'extended_status',
                'is_system_paused',
                'last_modified_by',
                'last_freeze_unfreeze_at',
            ]);
        });
    }
};
