<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Society>
 */
class SocietyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate ID card numbers starting from 20210046 onwards
        static $idCounter = 46;

        return [
            'id_card_number' => sprintf('202100%02d', $idCounter++),
            'password' => '121212', // Default password matching the SQL dump
            'name' => $this->faker->name(),
            'born_date' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address(),
            'regional_id' => $this->faker->randomElement([1, 2, 3]), // Use existing regional IDs
            'login_tokens' => null,
        ];
    }
}
