<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->text(),
            'hours' => json_encode([]),
            'postal_code' => fake()->postcode(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'image' => fake()->url()
        ];
    }
}
