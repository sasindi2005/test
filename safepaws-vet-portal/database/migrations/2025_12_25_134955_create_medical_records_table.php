<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('veterinarian_id')->nullable()->constrained('users')->nullOnDelete();

            $table->text('symptoms')->nullable();
            $table->text('diagnosis')->nullable();

            $table->json('prescription')->nullable(); // ✅ store as JSON
            $table->text('notes')->nullable();

            $table->string('attachment')->nullable(); // file/image path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
