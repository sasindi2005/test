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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('species')->default('Dog'); // Dog / Cat / etc.

            $table->string('breed')->nullable();

            $table->integer('age_years')->nullable();

            $table->enum('gender', ['Male', 'Female'])->nullable();

            $table->string('allergies')->nullable();

            $table->foreignId('branch_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
