<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'admin@minimarket.com'],
            [
                'name'      => 'Admin Minimarket',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );


        User::updateOrCreate(
            ['email' => 'ani@gmail.com'],
            [
                'name'      => 'Ani Rizqi Ziarotus S.',
                'password'  => Hash::make('password'),
                'role'      => 'customer',
                'is_active' => true,
            ]
        );

        $this->command->info('');
        $this->command->info('✅ User seeder selesai.');
        $this->command->info('');
        $this->command->info('   ADMIN    → admin@minimarket.com  / password');
        $this->command->info('   KASIR    → kasir@minimarket.com  / password');
        $this->command->info('   CUSTOMER → customer@email.com    / password');
        $this->command->info('');
    }
}
