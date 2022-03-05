<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Staff::create([
            'name' => "Admin",
            'email' => "admin@admin.com",
            'password' => Hash::make(123456),
            'national_id' => rand(1, 20),
            'role' => 'admin'
        ]);
        Staff::factory()->count(100)->create();
    }
}