<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\User;
use App\Models\UserTrainingPackage;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // public function index(){
      public function index(){
        $userTrainingPackages=UserTrainingPackage::with('user')->get();
        $gymTrainingPackages=UserTrainingPackage::with('gyms')->get();
        
        if(request()->ajax()){
            return Datatables()->of($userTrainingPackages)->addIndexColumn()
            ->addColumn('userName', function (UserTrainingPackage $userTrainingPackage) {
                return $userTrainingPackage->user->name;
            })
            ->addColumn('userEmail', function (UserTrainingPackage $userTrainingPackage) {
                return $userTrainingPackage->user->email;
            })
            ->addColumn('Name', function (UserTrainingPackage $gymTrainingPackages) {
                return $gymTrainingPackages->gyms->all()->name;
            })
            // ->addColumn('gymName', function (UserTrainingPackage $userTrainingPackage) {
            //     return $userTrainingPackage->gyms->name;
            // })
                ->rawColumns(['action'])
                ->make(true);
         }
         return view('attendances.index',[
         'userTrainingPackages' => $userTrainingPackages,
        ]);
      
      
    //   $users=User::all();
    //   // dd($users);     ` 
    //   return view('attendances.index',[
    //     'userTrainingPackages' => $userTrainingPackages,
    //     'users' => $users
    //   ]);
    // }
    }
  }
