<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    static $used = [];

    $categories = [
        'Smartphone',
        'Earphones',
        'Smartwatch',
        'Power Banks',
        'Bluetooth',
        'SportsShoes',
        'Slippers',
        'Boots',
        'Sandals',
        'ManTShirt'
    ];

    $available = array_diff($categories, $used);
    $category = array_shift($available);
    $used[] = $category;

    return [
        'name' => $category,
        'slug' => Str::slug($category),
    ];
}

}
