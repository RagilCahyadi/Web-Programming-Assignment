<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $userCounter = 76; // Start from 76 since we have 75 users in the dump

        $role = $this->faker->randomElement(['validator', 'officer']);

        return [
            'username' => $role . $userCounter++,
            'password' => Hash::make('password'), // Default password for new users
        ];
    }
}
