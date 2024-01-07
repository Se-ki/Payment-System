<?php

namespace Database\Factories;

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
        return [
            'course_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'profile_picture' => NULL,
            'school_id' => date('Y') . fake()->numberBetween(1000, 9999),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'year_level' => fake()->numberBetween(1, 6),
            'mobile_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
        ];
    }
}
