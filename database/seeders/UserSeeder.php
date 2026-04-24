<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['username' => 'admin'], 
            [
                'name' => 'Administrator',
                'email' => 'admin@reecefarm.test',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );

        // USER
        User::updateOrCreate(
            ['username' => 'user'], 
            [
                'name' => 'User Demo',
                'email' => 'user@reecefarm.test',
                'password' => Hash::make('user12345'), 
                'role' => 'user',
            ]
        );

        User::updateOrCreate(
            ['username' => 'john_doe'], 
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('john12345'),
                'role' => 'user',
            ]
        );
    }
}
