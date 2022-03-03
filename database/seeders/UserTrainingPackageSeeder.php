<?php

namespace Database\Seeders;

use App\Models\UserTrainingPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTrainingPackageSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        UserTrainingPackage::factory()->count(2)->create();
    }
}