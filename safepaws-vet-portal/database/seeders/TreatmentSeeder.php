<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Treatment;
use App\Models\Pet;
use App\Models\User;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        $brownie = Pet::where('name', 'Brownie')->first();
        $rusty   = Pet::where('name', 'Rusty')->first();

        $vet = User::where('role', 'vet')->first();

        if (!$brownie || !$rusty || !$vet) {
            $this->command->warn("Skipping TreatmentSeeder: Missing pets or vet user.");
            return;
        }

        Treatment::insert([
            [
                'pet_id' => $brownie->id,
                'vet_id' => $vet->id,
                'status' => 'ongoing',
                'notes' => 'Tick fever treatment started. Monitor appetite and hydration.',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1),
            ],
            [
                'pet_id' => $rusty->id,
                'vet_id' => $vet->id,
                'status' => 'completed',
                'notes' => 'Routine vaccination completed. No adverse reactions.',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(6),
            ],
        ]);
    }
}
