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
        $training_package = $this->faker->randomElement(TrainingPackage::all());
        return [
            'training_package_id' => $training_package['id'],
            'user_id' => $this->faker->randomElement(User::all())['id'],
            'date' => $this->faker->dateTimeThisYear($max = 'now'),
            'price' => $training_package['price'],
            'session_number' => $training_package['session_number']
        ];
    }
}