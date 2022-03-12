<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\User;
use App\Models\UserTrainingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    //==================Session Data============//
    public function sessionData($dataType, User $user)
    {
        $sessionData = "";
        if (count($user->sessions) == 0) {
            return "NO Session attendent";
        }
        foreach ($user->sessions as $session) {
            $sessionData .= $session->$dataType;
            $sessionData .= "<br>";
        }
        return $sessionData;
    }
    //====================index===================//
    public function index()
    {
        $users = collect();
        if (Auth::user()->hasRole('city_manager')) {
            $gyms = City::where('staff_id', Auth::user()->id)->first()->gyms;
            foreach ($gyms as $gym) {
                $gymUsers = $gym->users;
                foreach ($gymUsers as $user) {
                    $users->push($user);
                }
            }
        } elseif (Auth::user()->hasRole('gym_manager')) {
            $gymId = GymManager::where('staff_id', Auth::user()->id)->first()->gym_id;
            $users = Gym::find($gymId)->users;
        } else {
            $users = User::all();
        }

        if (request()->ajax()) {
            return Datatables()->of($users)->addIndexColumn()
                ->addColumn('cityName', function (User $user) {
                    return $user->gym->city->name;
                })
                ->addColumn('gymName', function (User $user) {
                    return $user->gym->name;
                })
                ->addColumn('userName', function (User $user) {
                    return $user->name;
                })
                ->addColumn('userEmail', function (User $user) {
                    return $user->email;
                })
                ->addColumn('sessionName', function (User $user) {
                    $sessionName = $this->sessionData('name', $user);
                    return  $sessionName;
                })
                ->addColumn('sessionTime', function (User $user) {
                    $sessionTime = $this->sessionData('start_at', $user);
                    return  $sessionTime;
                })

                ->rawColumns(['action', 'sessionName', 'sessionTime', 'sessionDate'])
                ->make(true);
        }
        return view('attendances.index', [
            'userTrainingPackages' => $users,
        ]);
    }
}
