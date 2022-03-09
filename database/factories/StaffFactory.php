<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory {

    protected $model = Staff::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {

        

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => Hash::make(123456),
            'national_id' => rand(1, 20),
           
        ];
    }
}