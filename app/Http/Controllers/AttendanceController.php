<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\User;
use App\Models\UserTrainingPackage;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
      $userTrainingPackages=UserTrainingPackage::get();
    //  dd( User::where('training_package_id','=',$userTrainingPackages));   
      // dd($userTrainingPackages);
      // foreach($userTrainingPackages as $UserTrainin){
 
      // //   $userId = $UserTrainin->user_id;
      // //   $gymId = $UserTrainin->gym_id;


      // //   // dd(User::find($userId)->name);
      // //   // dd(Gym::find($gymId)->name);
      // }  
      $users=User::all();
      // dd($users);      
      return view('attendances.index',[
        'userTrainingPackages' => $userTrainingPackages,
        'users' => $users
      ]);
    }
}
