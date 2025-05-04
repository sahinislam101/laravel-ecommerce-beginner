<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>User::first()->id,
           'category_id' => Category::inRandomOrder()->first()->id,
            'name' => fake()->realText(10),
           'description' => fake()->realText(1000),
            'price' => random_int(99,9999),
            'stock' =>  random_int(1,50),
            'image' => fake()->imageUrl(640, 480, 'products'),
        ];
    }
}
