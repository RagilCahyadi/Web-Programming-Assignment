<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regional;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regionals = [
            ['id' => 1, 'province' => 'DKI Jakarta', 'district' => 'Central Jakarta'],
            ['id' => 2, 'province' => 'DKI Jakarta', 'district' => 'South Jakarta'],
            ['id' => 3, 'province' => 'West Java', 'district' => 'Bandung'],
        ];

        foreach ($regionals as $regional) {
            Regional::create($regional);
        }
    }
}
