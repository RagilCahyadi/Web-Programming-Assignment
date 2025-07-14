<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'job_category' => 'Computing and ICT'],
            ['id' => 2, 'job_category' => 'Construction and building'],
            ['id' => 3, 'job_category' => 'Animals, land and environment'],
            ['id' => 4, 'job_category' => 'Design, arts and crafts'],
            ['id' => 5, 'job_category' => 'Design, arts and crafts'],
        ];

        foreach ($categories as $category) {
            JobCategory::create($category);
        }
    }
}
