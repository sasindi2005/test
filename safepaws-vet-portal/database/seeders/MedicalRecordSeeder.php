<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;
use App\Models\Pet;
use App\Models\User;

class MedicalRecordSeeder extends Seeder
{
    public function run(): void
    {
        $vet = User::first();
        $brownie = Pet::where('name', 'Brownie')->first();
        $rusty = Pet::where('name', 'Rusty')->first();

        MedicalRecord::create([
            'pet_id' => $brownie->id,
            'vet_id' => $vet->id,
            'symptoms' => 'Fever, lethargy, pale gums, appetite loss.',
            'diagnosis' => 'Tick Fever (Babesiosis)',
            'prescription' => [
                [
                    'medicine' => 'Doxycycline',
                    'dose' => '100mg',
                    'duration' => '7 days',
                ],
                [
                    'medicine' => 'Vitamin B Complex',
                    'dose' => '1 tab daily',
                    'duration' => '14 days',
                ],
            ],
            'notes' => 'Owner advised to ensure hydration. Follow-up after 3 days.',
        ]);

        MedicalRecord::create([
            'pet_id' => $rusty->id,
            'vet_id' => $vet->id,
            'symptoms' => 'Scratching, red patches, mild hair loss.',
            'diagnosis' => 'Dermatitis',
            'prescription' => [
                [
                    'medicine' => 'Cefalexin',
                    'dose' => '250mg BID',
                    'duration' => '5 days',
                ],
                [
                    'medicine' => 'Medicated Shampoo',
                    'dose' => 'Twice weekly',
                    'duration' => '2 weeks',
                ],
            ],
            'notes' => 'Avoid wet environment. Apply topical ointment.',
        ]);
    }
}
