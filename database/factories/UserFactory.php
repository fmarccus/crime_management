<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'photo' => 'user.png',
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'gender' => fake()->randomElement(["M", "F"]),
            'phone' => '09' . fake()->randomNumber($nbDigits = 9, $strict = true),
            'user_type' => 1,
            'rank' => fake()->randomElement([
                "n/a",
                "Police General",
                "Police Lieutenant General",
                "Police Major General",
                "Police Brigadier General Police Colonel",
                "Police Lieutenant Colonel",
                "Police Major",
                "Police Captain",
                "Police Lieutenant",
                "Police Executive Master Sergeant",
                "Police Chief Master Sergeant",
                "Police Senior Master Sergeant",
                "Police Master Sergeant",
                "Police Staff Sergeant Police Corporal",
                "Patrolman/Patrolwoman"
            ]),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
