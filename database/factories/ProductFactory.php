<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
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
            'name' => fake()->word,
            'description' => fake()->text,
            'price' => fake()->numberBetween(1000, 100000),
            'stock' => fake()->numberBetween(0, 100),
            'category' => fake()->randomElement(['food', 'drink', 'snack']),
            'image' => fake()->imageUrl()
        ];
    }
}
