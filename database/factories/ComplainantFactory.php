<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complainant>
 */
class ComplainantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'middlename' => fake()->lastName(),
            'surname' => fake()->lastName(),
            'age' => fake()->numberBetween(18, 60),
            'gender' => fake()->randomElement(["M", "F"]),
            'phone' => '09' . fake()->randomNumber($nbDigits = 9, $strict = true),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address()
        ];
    }
}
