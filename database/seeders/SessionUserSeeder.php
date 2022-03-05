<?php

namespace Database\Seeders;

use App\Models\SessionUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionUserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        SessionUser::factory()->count(2)->create();
    }
}