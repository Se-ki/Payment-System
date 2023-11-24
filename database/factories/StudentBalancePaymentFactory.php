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
        $uniqueIdentifier = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $currentDate = now()->format('Ymd');
        $generatedCode = $currentDate . $uniqueIdentifier;
        return [
            'student_id' => $this->faker->randomElement([1, 2, 3]),
            'sbp_description' => fake()->sentence(3),
            'sbp_receipt_number' => $generatedCode,
            'sbp_paid_amount' => fake()->numberBetween(100, 2000),
            'sbp_paid_change' => fake()->numberBetween(100, 2000),
            'sbp_balance_amount' => fake()->numberBetween(100, 2000),
            "sbp_semester" => $this->faker->randomElement(["1st Semester", "2nd Semester"]),
            'sbp_date_paid' => fake()->dateTimeThisYear(),
            'status' => fake()->randomElement(['Complete', 'Pending']),
            'encoder' => fake()->firstName()
        ];
    }
}
