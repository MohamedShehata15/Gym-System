<?php

namespace Database\Factories;

use App\Models\Session;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=UserCoachSession>
 */
class UserCoachSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'staff_id' => $this->faker->unique()->randomElement(
                Staff::role('coach')->get()           
            
                )['id'],
            'user_id' => $this->faker->randomElement(User::all())['id'],
            'session_id' => $this->faker->randomElement(Session::all())['id'],
        ];
    }
}
