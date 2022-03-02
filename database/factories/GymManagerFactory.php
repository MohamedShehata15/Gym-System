<?php

namespace Database\Factories;

use App\Models\Gym;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymManager>
 */
class GymManagerFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'gym_id' => $this->faker->randomElement(Gym::all())['id'],
            'staff_id' => $this->faker->randomElement(Staff::where('role', 'gym_manager')->get())['id']
        ];
    }
}