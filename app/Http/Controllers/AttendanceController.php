<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\User;
use App\Models\UserTrainingPackage;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
      public function index(){
        $users=User::all();
        // dd($users[0]->sessions);
        if(request()->ajax()){
            return Datatables()->of($users)->addIndexColumn()
            ->addColumn('userName', function (User $user) {
                return $user->name;
            })
            ->addColumn('userEmail', function (User $user) {
                return $user->email;
            })
            ->addColumn('sessionName', function (User $user) {
                $sessionName="";
                if(count($user->sessions) == 0){
                    return "NO Session attendent";
                }

                foreach($user->sessions as $session){
                    $sessionName .= $session->name;
                    $sessionName .="<br>";
                }
                return  $sessionName;
            })

                ->rawColumns(['action','sessionName'])
                ->make(true);
         }
         return view('attendances.index',[
         'userTrainingPackages' => $users,
        ]);
    }
  }
