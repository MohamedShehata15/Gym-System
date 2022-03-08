<?php

namespace Database\Seeders;

use App\Models\UserCoachSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCoachSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserCoachSession::factory()->count(10)->create();
    }
}
