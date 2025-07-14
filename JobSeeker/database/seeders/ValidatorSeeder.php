<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Validator;

class ValidatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $validators = [
            ['id' => 1, 'user_id' => 1, 'role' => 'validator', 'name' => 'Kamila Wibisono'],
            ['id' => 2, 'user_id' => 2, 'role' => 'officer', 'name' => 'Maya Kusmawati'] 
        ];

        foreach ($validators as $validator) {
            Validator::create($validator);
        }
    }
}
