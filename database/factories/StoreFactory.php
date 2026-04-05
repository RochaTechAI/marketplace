<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'phone' => $this->faker->phoneNumber,
            'mobile_phone' => $this->faker->phoneNumber,
            'slug' => $this->faker->slug,
        ];
    }
}