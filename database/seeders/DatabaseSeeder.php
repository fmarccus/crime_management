<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Angelo Krisanto',
            'surname' => 'Salonga',
            'gender' => 'M',
            'phone' => '09123456789',
            'email' => 'admin@admin.com',
            'password' => 'secretpassword',
            'user_type' => 0,
            'rank' => 'n/a',
            'email_verified_at' => now()
        ]);
        \App\Models\User::factory(1000)->create();
        \App\Models\Complainant::factory(1000)->create();
        \App\Models\Issue::factory(1500)->create();
    }
}
