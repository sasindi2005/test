<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('treatment_updates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('treatment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('veterinarian_id')->nullable()->constrained('users')->nullOnDelete();

            $table->enum('status', ['pending', 'ongoing', 'completed', 'cancelled'])->default('ongoing');
            $table->text('notes')->nullable();

            $table->string('attachment')->nullable(); // storage path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatment_updates');
    }
};
