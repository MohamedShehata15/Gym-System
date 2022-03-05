<?php

namespace Database\Seeders;

use App\Models\SessionStaff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionStaffSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        SessionStaff::factory()->count(10)->create();
    }
}