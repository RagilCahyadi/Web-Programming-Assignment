<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobVacancy;
use App\Models\AvailablePosition;

class JobVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Computing and ICT Jobs
        $vacancy1 = JobVacancy::create([
            'job_category_id' => 1,
            'company' => 'PT. Tech Solutions Indonesia',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'description' => 'We are looking for talented individuals to join our growing technology team. We offer competitive salary and great working environment with opportunities for career advancement in the field of Computing and ICT.'
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy1->id,
            'position' => 'Web Developer',
            'capacity' => 3,
            'apply_capacity' => 15
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy1->id,
            'position' => 'Mobile Developer',
            'capacity' => 2,
            'apply_capacity' => 10
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy1->id,
            'position' => 'System Analyst',
            'capacity' => 1,
            'apply_capacity' => 8
        ]);

        // Another Computing and ICT Job
        $vacancy2 = JobVacancy::create([
            'job_category_id' => 1,
            'company' => 'PT. Digital Innovation',
            'address' => 'Jl. Thamrin No. 456, Jakarta Pusat',
            'description' => 'Leading digital company seeking experienced IT professionals to develop cutting-edge software solutions and digital platforms.'
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy2->id,
            'position' => 'Software Engineer',
            'capacity' => 4,
            'apply_capacity' => 20
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy2->id,
            'position' => 'DevOps Engineer',
            'capacity' => 2,
            'apply_capacity' => 12
        ]);

        // Construction and Building Jobs
        $vacancy3 = JobVacancy::create([
            'job_category_id' => 2,
            'company' => 'PT. Konstruksi Mandiri',
            'address' => 'Jl. Gatot Subroto No. 789, Jakarta Selatan',
            'description' => 'Leading construction company seeking experienced professionals for various construction projects across Indonesia. Join our team and build the future of Indonesia.'
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy3->id,
            'position' => 'Civil Engineer',
            'capacity' => 2,
            'apply_capacity' => 8
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy3->id,
            'position' => 'Project Manager',
            'capacity' => 1,
            'apply_capacity' => 5
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy3->id,
            'position' => 'Site Supervisor',
            'capacity' => 3,
            'apply_capacity' => 12
        ]);

        // Animals, Land and Environment Jobs
        $vacancy4 = JobVacancy::create([
            'job_category_id' => 3,
            'company' => 'PT. Green Environment Solutions',
            'address' => 'Jl. Kemang Raya No. 321, Jakarta Selatan',
            'description' => 'Environmental consulting company focused on sustainable development and conservation. Join us in making Indonesia greener and more sustainable.'
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy4->id,
            'position' => 'Environmental Consultant',
            'capacity' => 2,
            'apply_capacity' => 10
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy4->id,
            'position' => 'Field Researcher',
            'capacity' => 3,
            'apply_capacity' => 15
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy4->id,
            'position' => 'Wildlife Conservation Specialist',
            'capacity' => 1,
            'apply_capacity' => 6
        ]);

        // Design, Arts and Crafts Jobs
        $vacancy5 = JobVacancy::create([
            'job_category_id' => 4,
            'company' => 'Creative Studio Nusantara',
            'address' => 'Jl. Senopati No. 654, Jakarta Selatan',
            'description' => 'Creative studio specializing in digital design and branding. We are looking for creative minds to join our team and create amazing visual experiences.'
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy5->id,
            'position' => 'Graphic Designer',
            'capacity' => 2,
            'apply_capacity' => 12
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy5->id,
            'position' => 'UI/UX Designer',
            'capacity' => 1,
            'apply_capacity' => 8
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy5->id,
            'position' => 'Art Director',
            'capacity' => 1,
            'apply_capacity' => 6
        ]);

        // Another Design, Arts and Crafts Job (for category ID 5)
        $vacancy6 = JobVacancy::create([
            'job_category_id' => 5,
            'company' => 'Artisan Craft Indonesia',
            'address' => 'Jl. Cikini Raya No. 987, Jakarta Pusat',
            'description' => 'Traditional craft company preserving Indonesian heritage through modern design approaches. We create unique handcrafted products for local and international markets.'
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy6->id,
            'position' => 'Craft Designer',
            'capacity' => 3,
            'apply_capacity' => 18
        ]);

        AvailablePosition::create([
            'job_vacancy_id' => $vacancy6->id,
            'position' => 'Product Development Specialist',
            'capacity' => 2,
            'apply_capacity' => 10
        ]);
    }
}
