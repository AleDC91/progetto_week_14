<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\ActivityUser;
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
    }
    public function configure()
    {
        return $this->afterCreating(function (ActivityUser $activityUser) {
            // controllo se esiste già la coppia attività-utente, per non avere la 
            // stessa attività assegnata piu volte allo stesso utente
            $existingRecord = ActivityUser::where('user_id', $activityUser->user_id)
                ->where('activity_id', $activityUser->activity_id)
                ->orderByDesc('id') 
                ->first();

            // Ise trovi corrispondenza, cancellala
            if ($existingRecord && $existingRecord->id !== $activityUser->id) {
                $existingRecord->delete();
            }
        });
    }
}
