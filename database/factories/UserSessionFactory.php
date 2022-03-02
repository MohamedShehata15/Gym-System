<?php

namespace Database\Factories;

use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=UserSession>
 */
class UserSessionFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'session_id' => $this->faker->randomElement(Session::all())['id'],
            'user_id' => $this->faker->randomElement(User::all())['id'],
        ];
    }
}