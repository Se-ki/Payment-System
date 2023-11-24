<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentBalancePayment>
 */
class StudentBalancePaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_login_id' => fake()->randomElement([1, 2, 3]),
            'description' => fake()->sentence(3),
            'balance_amount' => fake()->numberBetween(100, 2000),
            'date_paid' => fake()->dateTimeThisYear(),
            'status' => fake()->randomElement(['Complete', 'Pending']),
            'encoder' => fake()->firstName()
        ];
    }
}
