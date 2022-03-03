<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $date = $this->faker->dateTimeThisYear($max = 'now');
        return [
            'name' => $this->faker->company(),
            'start_at' => $date,
            'finish_at' => Carbon::parse($date)->addHours(2),
        ];
    }
}