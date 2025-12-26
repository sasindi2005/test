<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Fixed sample products (Realistic)
        $products = [
            [
                'name' => 'Deworming Tablets (Dogs & Cats)',
                'description' => 'Effective broad-spectrum deworming tablets. Recommended once every 3 months.',
                'price' => 950,
                'stock' => 40,
                'image' => 'https://picsum.photos/seed/deworm/600/400',
            ],
            [
                'name' => 'Flea & Tick Shampoo (500ml)',
                'description' => 'Removes fleas and ticks while keeping the coat healthy and shiny.',
                'price' => 1450,
                'stock' => 25,
                'image' => 'https://picsum.photos/seed/shampoo/600/400',
            ],
            [
                'name' => 'Pet First Aid Kit',
                'description' => 'Portable first aid kit with bandages, antiseptic spray, and essentials for emergencies.',
                'price' => 4200,
                'stock' => 15,
                'image' => 'https://picsum.photos/seed/aidkit/600/400',
            ],
            [
                'name' => 'Dog Food Premium 10kg',
                'description' => 'High-protein premium dog food with vitamins and minerals for healthy growth.',
                'price' => 8900,
                'stock' => 12,
                'image' => 'https://picsum.photos/seed/dogfood/600/400',
            ],
            [
                'name' => 'Cat Litter Sand 10L',
                'description' => 'Dust-free, odor-control cat litter for clean and comfortable use.',
                'price' => 2300,
                'stock' => 30,
                'image' => 'https://picsum.photos/seed/litter/600/400',
            ],
            [
                'name' => 'Vitamin Supplement Syrup',
                'description' => 'Daily vitamin supplement for pets to improve immunity and energy levels.',
                'price' => 1650,
                'stock' => 18,
                'image' => 'https://picsum.photos/seed/vitamin/600/400',
            ],
            [
                'name' => 'Pet Collar + Name Tag',
                'description' => 'Strong adjustable collar and a stainless-steel name tag.',
                'price' => 850,
                'stock' => 50,
                'image' => 'https://picsum.photos/seed/collar/600/400',
            ],
            [
                'name' => 'Dog Chew Toy (Rubber)',
                'description' => 'Durable rubber chew toy for teething and stress relief.',
                'price' => 650,
                'stock' => 35,
                'image' => 'https://picsum.photos/seed/toy/600/400',
            ],
        ];

        foreach ($products as $item) {
            Product::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'image' => $item['image'],
                'is_active' => true,
            ]);
        }

        // ✅ Add extra random products for testing UI pagination
        Product::factory()->count(16)->create();
    }
}
