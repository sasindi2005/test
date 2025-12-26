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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // Optional link to a registered user
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Donor details
            $table->string('donor_name');
            $table->string('donor_phone')->nullable();
            $table->decimal('amount', 10, 2);

            // Payment info
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->string('payment_gateway')->nullable();
            $table->string('payment_reference')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
