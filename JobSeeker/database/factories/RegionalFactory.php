<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Regional>
 */
class RegionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provinces = [
            'DKI Jakarta' => ['Central Jakarta', 'South Jakarta', 'North Jakarta', 'East Jakarta', 'West Jakarta'],
            'West Java' => ['Bandung', 'Bogor', 'Depok', 'Bekasi', 'Cimahi'],
            'Central Java' => ['Semarang', 'Solo', 'Yogyakarta', 'Magelang', 'Salatiga'],
            'East Java' => ['Surabaya', 'Malang', 'Kediri', 'Blitar', 'Mojokerto'],
        ];

        $province = $this->faker->randomElement(array_keys($provinces));
        $district = $this->faker->randomElement($provinces[$province]);

        return [
            'province' => $province,
            'district' => $district,
        ];
    }
}
