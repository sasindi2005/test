<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 350, 7500),
            'stock' => $this->faker->numberBetween(0, 80),
            'image' => 'https://picsum.photos/seed/' . Str::slug($name) . '/600/400',
            'is_active' => true,
        ];
    }
}
