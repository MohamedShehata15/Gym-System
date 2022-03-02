<?php

namespace Database\Factories;

use App\Models\TrainingPackage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=UserTrainingPackage>
 */
class UserTrainingPackageFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'training_package_id' => $this->faker->randomElement(TrainingPackage::all())['id'],
            'user_id' => $this->faker->randomElement(User::all())['id'],
            'date' => $this->faker->dateTimeThisYear($max = 'now'),
            'price' => rand(50, 1000)
        ];
    }
}