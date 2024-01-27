<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created = $this->faker->dateTimeBetween('-60 days', '-1 days');

        return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(),
            'benefit' => fake()->paragraph(),
            'expiration' => fake()->numberBetween(0, 30),
            'created_at' => $created,
        ];
    }
}
