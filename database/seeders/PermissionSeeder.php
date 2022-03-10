<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //creating roles
        $admin = Role::create(['name' => 'Super-Admin']);
        $gymManager = Role::create(['name' => 'gym_manager']);
        $cityManager = Role::create(['name' => 'city_manager']);
        $coach = Role::create(['name' => 'coach']);

        //creating permissions
        Permission::create(['name'=>'gyms']);
        Permission::create(['name'=>'gym-managers']);
        Permission::create(['name'=>'sessions']);
        Permission::create(['name'=>'buy-package']);
        

       $gymManager->syncPermissions(['gyms','sessions','buy-package']);
       $cityManager->syncPermissions(['gyms','gym-managers','sessions','buy-package']);



    }
}
