<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gym>
 */
class GymFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $city = $this->faker->randomElement(City::all());
        return [
            'name' => $this->faker->word(),
            'image' => $this->faker->image(),
            'city_id' =>  $city['id'],
            'created_by' => 
                Staff::role('city_manager')->where('id',$city->staff_id)->first()['name']
            
        ];
    }
}