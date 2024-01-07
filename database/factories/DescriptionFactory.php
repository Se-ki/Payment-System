<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Description>
 */
class DescriptionFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name' => $this->faker->sentence(nbWords: 2, variableNbWords: false),
            'status' => $this->faker->randomElement([1, 0]),
        ];
    }
}
