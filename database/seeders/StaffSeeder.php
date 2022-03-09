<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeding Admin
        $admin =  Staff::create([
            'name' => "Admin",
            'email' => "admin@admin.com",
            'password' => Hash::make(123456),
            'national_id' => rand(1, 20),
            
        ]);
        $admin->assignRole('Super-Admin');

        //Seeding Gym Managers
        $gymManagers = Staff::factory()->count(15)->create();

        foreach ($gymManagers as $gymManager) {
        
            $gymManager->assignRole('gym_manager');
        }

        //Seeding City Managers
        $cityManagers = Staff::factory()->count(10)->create();
        foreach ($cityManagers as $cityManager) {
        
            $cityManager->assignRole('city_manager');
        }

        //Seeding Coaches
        $coaches = Staff::factory()->count(10)->create();

        foreach ($coaches as $coach) {
        
            $coach->assignRole('coach');
        }
    }
}
