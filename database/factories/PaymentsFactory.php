<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments>
 */
class PaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            "semester_id" => $this->faker->randomElement([1, 2]),
            "description" => $this->faker->sentence(2),
            "amount" => $this->faker->numberBetween(100, 2000),
            "deadline" => $this->faker->dateTimeThisYear(),
            "encoded_by" => $this->faker->name(),
            "created_at" => $this->faker->dateTimeBetween('-2 years', '1 year')
        ];
    }
}
