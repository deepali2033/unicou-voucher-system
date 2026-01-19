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
        if (!Schema::hasTable('book_services')) {
            Schema::create('book_services', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
                $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
                $table->string('service_name');
                $table->string('customer_name');
                $table->string('email');
                $table->string('phone');
                $table->string('street_address');
                $table->string('city');
                $table->string('state');
                $table->string('zip_code');
                $table->integer('bedrooms')->nullable();
                $table->integer('bathrooms')->nullable();
                $table->string('extras')->nullable();
                $table->string('frequency')->nullable();
                $table->string('square_feet')->nullable();
                $table->date('booking_date');
                $table->time('booking_time')->nullable();
                $table->string('parking_info')->nullable();
                $table->string('flexible_time')->nullable();
                $table->string('entrance_info')->nullable();
                $table->text('special_instructions')->nullable();
                $table->decimal('price', 10, 2)->nullable();
                $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_services');
    }
};
