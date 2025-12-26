<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@safepaws.lk'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Vet User
        User::firstOrCreate(
            ['email' => 'vet@safepaws.lk'],
            [
                'name' => 'Dr. Kasun Perera',
                'password' => Hash::make('password'),
                'role' => 'vet',
            ]
        );
    }
}
