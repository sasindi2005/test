<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        Owner::insert([
            [
                'full_name' => 'Nimali Silva',
                'phone' => '+94 77 111 2222',
                'email' => 'nimali@example.com',
                'address' => 'No. 45, Matale',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Kamal Perera',
                'phone' => '+94 77 123 4567',
                'email' => 'kamal@example.com',
                'address' => 'No. 15, Ward Place, Colombo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
