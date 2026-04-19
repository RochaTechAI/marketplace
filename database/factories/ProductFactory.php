<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'body' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'slug' => $this->faker->slug,
        ];
    }
}