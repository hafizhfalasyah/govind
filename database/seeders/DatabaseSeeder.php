<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'img' => 'default.png',
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '08123456789',
            'address' => 'Malang',
            'role' => 'admin',
            'password' => bcrypt('12345'),
        ]);

        User::factory()->create([
            'img' => 'default.png',
            'name' => 'User',
            'email' => 'user@example.com',
            'phone' => '08123456789',
            'address' => 'Malang',
            'role' => 'user',
            'password' => bcrypt('12345'),
        ]);
    }
}
