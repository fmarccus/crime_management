<?php

namespace Database\Factories;

use App\Models\User;
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
        $officers = User::where('user_type', 1)->get()->pluck('id')->toArray();
        $complainants = User::where('user_type', 3)->get()->pluck('id')->toArray();
        $investigators = User::where('user_type', 2)->get()->pluck('id')->toArray();

        $user_id = $officers[array_rand($officers)];
        $complainant_id = $complainants[array_rand($complainants)];
        $investigator_id = $investigators[array_rand($investigators)];

        return [
            'user_id' => $user_id,
            'complainant_id' => $complainant_id,
            'investigator_id' => $investigator_id,
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
