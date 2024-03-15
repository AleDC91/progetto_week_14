<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => rtrim(fake()->text(20), '.'),
            "description" => fake()->text(),
            "owner_id" => User::inRandomOrder()->first()->id,
            "start_date" => now(),
            "client_name" => fake()->company(),
            "priority" => fake()->randomElement(['low', 'medium', 'high']),
        ];
    }

}
