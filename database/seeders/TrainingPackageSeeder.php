<?php

namespace Database\Seeders;

use App\Models\TrainingPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingPackageSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        TrainingPackage::factory()->count(2)->create();
    }
}