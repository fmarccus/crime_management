<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [



            'issue_id' => fake()->numberBetween(1, 1500),
            'person_name' => fake()->name(),
            'person_type' => fake()->randomElement([
                "witness",
                "suspect",
            ]),
            'gender' => fake()->randomElement(["Male", "Female"]),
            'dob' => fake()->date(),
            'address' => fake()->address(),
            'contact' => '09' . fake()->randomNumber($nbDigits = 9, $strict = true),
            'height' => fake()->numberBetween(100, 200),
            'weight' => fake()->numberBetween(50, 200),
            'hair' => fake()->colorName(),
            'eye' => fake()->colorName(),
            'ethnicity' => fake()->randomElement(["Filipino"]),
            'statement' => fake()->text($maxNbChars = 250),
            'identification' => 'user.png',


        ];
    }
}
