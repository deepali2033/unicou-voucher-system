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
        Schema::create('referral_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');
            $table->enum('reward_type', ['voucher', 'bonus_points', 'discount'])->default('voucher')->comment('Type of reward');
            $table->decimal('reward_value', 10, 2)->comment('Value of reward per referral');
            $table->decimal('max_reward', 10, 2)->nullable()->comment('Maximum total reward per user/campaign');
            $table->json('applicable_user_types')->nullable()->comment('JSON array of user types: student, agent, reseller, etc.');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'inactive', 'frozen'])->default('active');
            $table->string('unique_code')->unique()->comment('Unique referral campaign code');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('last_modified_by')->nullable();
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('last_modified_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_campaigns');
    }
};
