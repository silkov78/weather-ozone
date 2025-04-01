<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Observation>
 */
class  ObservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'datetime' => fake()->dateTime(),
            'temperature' => fake()->randomFloat(2, 4.5, 13.5),
            'cloud_cover' => fake()->randomFloat(0, 0, 100),
            'weather_code' => fake()->randomElement(['1', '0', '45', '3']),
            'ozone' => fake()->randomFloat(0, 250, 600)
        ];
    }
}
