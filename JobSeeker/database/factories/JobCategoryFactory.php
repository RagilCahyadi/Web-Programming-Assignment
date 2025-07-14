<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobCategory>
 */
class JobCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Computing and ICT',
            'Construction and building',
            'Animals, land and environment',
            'Design, arts and crafts',
            'Healthcare and medical',
            'Education and training',
            'Engineering and manufacturing',
            'Business and finance',
        ];

        return [
            'job_category' => $this->faker->randomElement($categories),
        ];
    }
}
