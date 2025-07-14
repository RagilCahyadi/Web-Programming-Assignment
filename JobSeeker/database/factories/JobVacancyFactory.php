<?php

namespace Database\Factories;

use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobVacancy>
 */
class JobVacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_category_id' => JobCategory::factory(),
            'company' => 'PT. ' . $this->faker->company(),
            'address' => $this->faker->address(),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
