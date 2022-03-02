<?php

namespace Database\Seeders;

use App\Models\GymCoach;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GymCoachSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        GymCoach::factory()->count(50)->create();
    }
}