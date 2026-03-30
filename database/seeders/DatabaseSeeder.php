<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Testimonial;
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
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '08123456789',
            'address' => 'Malang',
            'role' => 'admin',
            'password' => bcrypt('12345'),
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'phone' => '08123456789',
            'address' => 'Malang',
            'role' => 'user',
            'password' => bcrypt('12345'),
        ]);

        Testimonial::factory()->create([
            'name' => 'Resky Fernanda',
            'occupation' => 'Product Designer at Tokopedia',
            'text' => 'Learning at GAE is very engaging, structured, and aligned with the needs of the modern workforce. The mentors are experienced, and the material is highly relevant to current industry developments.'
        ]);

        Testimonial::factory()->create([
            'name' => 'Nadia Putri',
            'occupation' => 'UI/UX Designer',
            'text' => "GAE's programs greatly helped me understand concepts more clearly. The materials are complete and easy to follow, suitable for both beginners and professionals."
        ]);

        Testimonial::factory()->create([
            'name' => 'Dimas Pratama',
            'occupation' => 'Fullstack Developer',
            'text' => "The training quality is outstanding! The facilitators explain in detail and provide real examples from the industry."
        ]);
    }
}
