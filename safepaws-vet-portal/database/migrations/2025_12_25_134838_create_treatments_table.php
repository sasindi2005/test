<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('veterinarian_id')->nullable()->constrained('users')->nullOnDelete(); 
            // ✅ If you have a vets table, change: constrained('veterinarians')

            $table->string('title')->nullable();
            $table->text('notes')->nullable();

            $table->enum('status', ['pending', 'ongoing', 'completed', 'cancelled'])->default('pending');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
