<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'role' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => 'admin'
        ]);
        Student::factory(400)->create();
    }
}
