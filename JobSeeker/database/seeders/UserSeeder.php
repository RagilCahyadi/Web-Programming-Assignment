<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['id' => 1, 'username' => 'validator2', 'password' => 'password'],
            ['id' => 2, 'username' => 'offcier', 'password' => 'password']
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
