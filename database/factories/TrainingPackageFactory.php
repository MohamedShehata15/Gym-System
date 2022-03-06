<?php

namespace Database\Factories;

use App\Models\Gym;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=TrainingPackage>
 */
class TrainingPackageFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'name' => $this->faker->title(),
            'price' => rand(50, 1000),
            'session_number' => rand(2, 10),
            'gym_id' => $this->faker->randomElement(Gym::all())['id']
        ];
    }
}