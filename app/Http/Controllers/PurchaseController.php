<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\City;
use App\Models\Gym;
use App\Models\TrainingPackage;
use App\Models\UserTrainingPackage;
use App\Models\GymManager;


class PurchaseController extends Controller
{

    public function index()
    {
        if (Auth::user()->hasRole('Super-Admin')) {
            $purchases = UserTrainingPackage::with('user', 'package')->get();
        } elseif (Auth::user()->hasRole('city_manager')) 
        {
            $purchases = collect();

           $city = City::where('staff_id',Auth::user()->id)->first();
           if(isset($city))
           {
            $gyms = Gym::where('city_id',$city->id)->get();
          
            $tIds=[];
             foreach($gyms as $gym)
             {
              $trainingPackages=TrainingPackage::where('gym_id',$gym->id)->get();
              $ids = $trainingPackages->pluck('id');
              foreach($ids as $id)
              {
                 array_push($tIds,$id);
              }
                 
             }
             
 
             foreach($tIds as $tId)
             {   
                 
                 $userTrainingPackages = UserTrainingPackage::with('user', 'package')->where('training_package_id',$tId)->get();
                 foreach($userTrainingPackages as $trainingPackage)
                 {
                     $purchases->push($trainingPackage);
                 };
             }

           }
           
           
        }else if (Auth::user()->hasRole('gym_manager'))
        {   
            $purchases = collect();
            $gym = GymManager::where('staff_id',Auth::user()->id)->first();
            if(isset($gym))
            {
            $tIds=[];
            $trainingPackages=TrainingPackage::where('gym_id',$gym->gym_id)->get();
            $ids = $trainingPackages->pluck('id');
             foreach($ids as $id)
             {
                array_push($tIds,$id);
             }
           
             
             foreach($tIds as $tId)
             {   
                 
                 $userTrainingPackages = UserTrainingPackage::with('user', 'package')->where('training_package_id',$tId)->get();
                 foreach($userTrainingPackages as $trainingPackage)
                 {
                     $purchases->push($trainingPackage);
                 };
             }

            }
           
            

        }

        if (request()->ajax()) {
            return datatables()->of($purchases)
                ->addColumn('userName', function (UserTrainingPackage $purchases) {
                    return $purchases->user->name;
                })
                ->addColumn('email', function (UserTrainingPackage $purchases) {
                    return $purchases->user->email;
                })
                ->addColumn('packageName', function (UserTrainingPackage $purchases) {
                    return $purchases->package->name;
                })
                ->addColumn('cityName', function (UserTrainingPackage $purchases) {
                    $cityId = Gym::find($purchases->package->gym_id)->city_id;
                    $cityName = City::find($cityId)->name;
                    return  $cityName;
                })
                ->addColumn('gymName', function (UserTrainingPackage $purchases) {
                    $gymName = Gym::find($purchases->package->gym_id)->name;
                    return $gymName;
                })


                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0);" onClick = "deleteFunc(' . $data->id . ')"class="btn btn-danger btn-sm mx-2">Delete</a>';
                    return $button;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('purchases.index');
    }

    public function destroy(Request $request)
    {

        $package = UserTrainingPackage::where('id', $request->id)->delete();
        return Response()->json($package);
    }
}
