<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
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
            "project_id" => Project::inRandomOrder()->first()->id,
            "start_date" => fake()->date(),
            "end_date" => fake()->date(),
            "status" => fake()->randomElement(['pending', 'in_progress', 'completed']),
            "priority" => fake()->randomElement(['low', 'medium', 'high']),
            "estimated_hours" => fake()->numberBetween(1, 30)
        ];

    }
}
