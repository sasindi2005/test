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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('appointment_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('pet_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('temperature', 4, 1)->nullable(); // e.g. 38.5
            $table->decimal('weight', 5, 2)->nullable();      // e.g. 12.50 kg
            $table->integer('heart_rate')->nullable();
            $table->string('last_meal')->nullable();

            $table->text('clinical_notes')->nullable();
            $table->string('diagnosis')->nullable();

            $table->decimal('total_cost', 10, 2)->default(0);

            $table->string('signature_path')->nullable(); // image path

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
