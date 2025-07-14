<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionalSeeder::class,
            JobCategorySeeder::class,
            SocietySeeder::class,
            UserSeeder::class,
            ValidatorSeeder::class,
            JobVacancySeeder::class,
        ]);
    }
}
