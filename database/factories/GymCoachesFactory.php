<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Base;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=GymCoaches>
 */
class GymCoachesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'name'=>$this->faker->name,  

              ];
    }
}
