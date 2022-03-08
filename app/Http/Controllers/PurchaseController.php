<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\City;
use App\Models\Gym;
use App\Models\UserTrainingPackage;

class PurchaseController extends Controller
{

    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $purchases = UserTrainingPackage::with('user', 'package')->get();
        } elseif (Auth::user()->role == 'city_manager') {

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
