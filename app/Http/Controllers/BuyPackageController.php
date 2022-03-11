<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\User;
use App\Models\City;
use App\Models\TrainingPackage;

class BuyPackageController extends Controller
{
   public function create()
   {
       $loginUser = Auth::user();
       $cities = City::all();
       $gyms = Gym::all();
       $users = User::all();
       $packages= TrainingPackage::all();
       if( $loginUser->hasRole('gym_manager'))
          {
            $gymId = GymManager::where('staff_id',$loginUser->id)->first()->gym_id;
            $users = User::where('gym_id',$gymId)->get();
            $packages= TrainingPackage::where('gym_id',$gymId)->get();
          }
        else if ($loginUser->hasRole('city_manager'))
        {
            $cityId = City::where('staff_id',$loginUser->id)->first()->id;
            $gyms = Gym::where('city_id',$cityId)->get();
        }
        return view('buyPackage.create',[
          'users' => $users,
          'packages' => $packages,
          'gyms' => $gyms,
          'cities'=> $cities,
      ]);
      
   }
    
}
