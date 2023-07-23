<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween($min = 2, $max = 200),
            'complainant_id' => fake()->numberBetween($min = 1, $max = 2000),
            'issue' => fake()->text($maxNbChars = 250),
            'date' => fake()->dateTimeBetween($startDate = '2023-01-01', $endDate = 'now', $timezone = null),
            'area' => fake()->randomElement([
                "Aguho",
                "Magtanggol",
                "Martires del 96",
                "Poblacion",
                "San Pedro",
                "San Roque",
                "Santa Ana",
                "Santo Rosario Kanluran",
                "Santo Rosario Silangan",
                "Tabacalera"
            ]),
            'type' => fake()->randomElement([
                "Assault",
                "Burglary",
                "Robbery",
                "Theft",
                "Fraud",
                "Vandalism",
                "Kidnapping",
                "Homicide",
                "Drug-related offenses",
                "Cybercrime",
                "Harassment",
                "Domestic violence",
                "Sexual assault",
                "Arson",
                "Carjacking",
                "Human trafficking",
                "Hate crime",
                "Money laundering",
                "Identity theft",
                "Embezzlement"
            ]),
            'severity' => fake()->randomElement([
                "Normal",
                "Severe",
                "Critical",
            ]),
            'status' => fake()->randomElement([
                "Open",
                "Processing",
                "Completed",
            ]),
        ];
    }
}
