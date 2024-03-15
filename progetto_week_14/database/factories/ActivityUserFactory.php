<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityUser>
 */
class ActivityUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'activity_id' => Activity::inRandomOrder()->first()->id,
        ];

        // non riesco a trovare il modo di generare coppie utente-attività univoche :(
        // vedrò di gestirla in fase di query al db, estraendo dal db solo valori unici
    }
}
