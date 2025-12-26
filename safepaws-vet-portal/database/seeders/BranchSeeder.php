<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::insert([
            [
                'name' => 'Matale Main Branch',
                'address' => 'Kandy Road, Ukuwela',
                'phone' => '066-222-3344',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Colombo 07 Branch',
                'address' => 'Rosmead Place, Colombo 07',
                'phone' => '011-555-7788',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
