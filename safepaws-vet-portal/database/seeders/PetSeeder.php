<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;
use App\Models\Owner;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        $owner1 = Owner::where('email', 'nimali@example.com')->first();
        $owner2 = Owner::where('email', 'kamal@example.com')->first();

        Pet::insert([
            [
                'owner_id' => $owner1->id,
                'name' => 'Brownie',
                'species' => 'Dog',
                'breed' => 'Mixed',
                'age' => 4,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => $owner2->id,
                'name' => 'Rusty',
                'species' => 'Dog',
                'breed' => 'Golden Retriever',
                'age' => 5,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
