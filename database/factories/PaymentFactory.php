<?php

namespace Database\Factories;

use App\Models\UserLogin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'user_login_id' => UserLogin::factory(),
            "semester" => $this->faker->randomElement(["1st Semester", "2nd Semester"]),
            "code" => $generatedCode,
            "description" => $this->faker->sentence(2),
            "amount" => $this->faker->numberBetween(100, 2000),
            "deadline" => $this->faker->dateTimeThisYear(),
            "encoded_by" => $this->faker->name(),
            "created_at" => $this->faker->dateTimeBetween('-2 years', '1 year')
        ];
    }
}
