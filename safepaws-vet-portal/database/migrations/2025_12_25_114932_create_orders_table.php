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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Link to user (nullable in case of guest orders)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Order details
            $table->string('order_number')->unique();
            $table->decimal('total', 10, 2);
            $table->string('currency')->default('LKR');

            // Customer details
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');

            // Optional notes
            $table->text('notes')->nullable();

            // Payment & shipping status
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->enum('shipping_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');

            // Payment gateway info
            $table->string('payment_gateway')->nullable(); // e.g., PayHere
            $table->string('payment_reference')->nullable(); // e.g., PayHere payment ID

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
