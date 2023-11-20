<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentRecords>
 */
class PaymentRecordsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement([1, 2, 3]),
            'receipt_number' => fake()->numberBetween(100000, 999999),
            'reference_number' => fake()->numberBetween(9876543212345, 1234567890987),
            'description' => fake()->sentence(3),
            'mode' => "GCASH",
            'paid_date' => fake()->dateTimeThisYear(),
            'amount' => fake()->numberBetween(100, 2000)
        ];
    }
}
