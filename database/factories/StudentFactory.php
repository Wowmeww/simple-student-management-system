<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courses = ['BSIT', 'BSIS', 'BSAIS', 'BSCS', 'BSA'];
        return [
            'course' => fake()->randomElement($courses),
            'year' => rand(1, 4),
            'address' => fake()->address(),
            'age' => rand(17, 25),
            'sex' => fake()->randomElement(['male', 'female']),
            'user_id' => User::factory()->create()
        ];
    }
}
