<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin RNR Digital Printing',
                'email' => 'admin@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Manager RNR',
                'email' => 'manager@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('manager123'),
            ],
            [
                'name' => 'Staff Produksi',
                'email' => 'produksi@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('produksi123'),
            ],
            [
                'name' => 'Staff Marketing',
                'email' => 'marketing@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('marketing123'),
            ],
            [
                'name' => 'Customer Service',
                'email' => 'cs@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('cs123'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
