<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentPaymentRecord>
 */
class StudentPaymentRecordFactory extends Factory
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
            'spr_description' => fake()->sentence(3),
            'spr_receipt_number' => $generatedCode,
            'spr_reference_number' => fake()->numberBetween(9876543212345, 1234567890987),
            'spr_paid_date' => fake()->dateTimeThisYear(),
            'spr_amount' => fake()->numberBetween(100, 2000),
            "spr_semester" => $this->faker->randomElement(["1st Semester", "2nd Semester"]),
            'spr_mode_of_payment' => "GCASH",
        ];
    }
}
