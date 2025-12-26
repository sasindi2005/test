<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BranchSeeder::class,
            OwnerSeeder::class,
            PetSeeder::class,
            TreatmentSeeder::class,
            MedicalRecordSeeder::class,

            // ✅ Shop data
            ProductSeeder::class,
        ]);
    }
}
