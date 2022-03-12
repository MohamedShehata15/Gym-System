<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\City;
use App\Models\Gym;
use App\Models\GymManager;
use App\Http\Requests\GymManagerRequest;
use App\Http\Requests\GymManagerUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class GymManagerController extends Controller {
    public function index() {
        $gymManagers = Staff::role('gym_manager')->get();

        if (Auth::user()->hasRole('city_manager')) {
            $gyms = City::where('staff_id', Auth::user()->id)->first()->gyms;
            $gymManagers = collect();
            foreach ($gyms as $gym) {
                $gymMangs = $gym->gymManager;
                foreach ($gymMangs as $manager) {
                    $gymManagers->push($manager);
                }
            }
        }

        if (request()->ajax()) {
            return datatables()->of($gymManagers)
                ->addColumn('action', function ($data) {
                    $banStatus = $data->isBanned() ? "unban" : "ban";
                    $buttonColor = $data->isBanned() ? "secondary" : "warning";
                    $button = '<a href="' . route('gym-managers.edit', $data->id) . '" class="btn btn-info btn-sm mx-2">Edit</a>';
                    $button .= '<a href="javascript:void(0);" onClick = "deleteFunc(' . $data->id . ')"class="btn btn-danger btn-sm mx-2">Delete</a>';
                    $button .= '<a href="javascript:void(0);" onClick = "ban(' . $data->id . ')"class="btn btn-' . $buttonColor . ' btn-sm mx-2">' . $banStatus . '</a>';
                    return $button;
                })
                ->addColumn('gym-city', function ($data) {
                    $gymManage = GymManager::where('staff_id', $data->id)->first();
                    if(isset($gymManage))
                    {
                    $gym = Gym::find($gymManage->gym_id);
                    $city = City::find($gym->city_id);
                    return $gym->name . '-' . $city->name;
                    }
                    return "None";
                    
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('gym-managers.index');
    }
    //--------------------------- edit staff member -----------------------
    public function edit($staffId) {

        $staff = Staff::find($staffId);
        $gymId = gymManager::where('staff_id', $staffId)->first()->gym_id;
        $gym = Gym::find($gymId);
        $cityGyms = $gym->city->gyms;
        $cities = City::all();
        $gyms = Gym::all();
        
        return view('gym-managers.edit', [
            'staff' => $staff,
            'gyms' => $gyms,
            'cities' => $cities,
            'gym' => $gym,
            'cityGyms' => $cityGyms

        ]);
    }




    public function update($staffId, GymManagerUpdateRequest $request) {
        $requestData = request()->all();
        if (isset($requestData['avatar'])) {
            $imageName = time() . '.' . $requestData['avatar']->getClientOriginalName();
            $requestData['avatar']->move(public_path('images'), $imageName);
            $requestData['avatar'] = $imageName;
        } else {
            $imageName = Staff::find($staffId)->avatar;
        }

        if (isset($request->oldpassword)) {
            $hashedPassword = Staff::find($staffId)->password;
            if (Hash::check($request->oldpassword, $hashedPassword)) {

                $user = Staff::find($staffId);
                $user->password = bcrypt($request->password);
                $user->save();
            } else {
                return Redirect::back()->withErrors(['msg' => 'Wrong old password']);
            }
        }


        Staff::find($staffId)->update([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'avatar' => $imageName,
            'national_id' => $requestData['national_id'],
           

        ]);
        gymManager::where('staff_id', $staffId)->update([
            'gym_id' => $requestData['gym']
        ]);

        // $gym->gym_id = $requestData['gym'];
        // $gym->save();

        return redirect()->route('gym-managers.index');
    }
    //----------------------- create new member -------------------------
    public function create() {
        $cities = City::all();
        $gyms = Gym::all();
        return view(
            'gym-managers.create',
            [
                'cities' => $cities,
                'gyms' => $gyms,
            ]
        );
    }
    public function store(GymManagerRequest $request) {
        $requestData = request()->all();
        if (isset($requestData['avatar'])) {
            $imageName = time() . '.' . $requestData['avatar']->getClientOriginalName();
            $requestData['avatar']->move(public_path('images'), $imageName);
        } else {
            $imageName = 'user_avatar.png';
        }
        $gymManager = Staff::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'avatar' => $imageName,
            'national_id' => $requestData['national_id'],
            

        ]);
        $gymManager->assignRole('gym_manager');

        $staffMember = Staff::where('name', $requestData['name'])->first();



        gymManager::Create(
            [
                'staff_id' => $staffMember->id,


                'gym_id' => $requestData['gym']
            ]
        );


        return redirect()->route('gym-managers.index');
    }
    //-------------------- delete member -------------------------------

    public function destroy(Request $request) {

        $member = Staff::where('id', $request->id)->delete();
        return Response()->json($member);
    }
    public function ban(Request $request) {

        $member = Staff::find($request->id);
        $ban = $member->isBanned() ? $member->unban() : $member->ban();
        return Response()->json($ban);
    }
}