<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\City;
use App\Models\Gym;
use App\Models\GymCoach;
use App\Models\GymManager;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Requests\CoachRequest;
use App\Http\Requests\CityManagerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class coachController extends Controller {
    public function index() {
        if (request()->ajax()) {
            return datatables()->of(Staff::role('coach')->get())
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('coaches.show', $data->id) . '" class="btn btn-info btn-sm mx-2">Show</a>';
                    $button .= '<a href="javascript:void(0);" onClick = "deleteFunc(' . $data->id . ')"class="btn btn-danger btn-sm mx-2">Delete</a>';
                    return $button;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('coaches.index');
    }
    //--------------------------- edit staff member -----------------------
    public function edit($staffId) {
        $cities = City::all();
        $staff = Staff::find($staffId);

        return view('coaches.edit', [
            'cities' => $cities,
            'coach' => $staff
        ]);



        // dd('-------------------------------');


        $coachedGyms = gymCoach::where('staff_id', $staffId)->get();

        $gymsCollection = collect([]);

        foreach ($coachedGyms as $coachedGym) {
            $gym = Gym::find($coachedGym->gym_id);
            $gymsCollection->push($gym);
        }

        //dd($gymsCollection[0]);
        $gymsCity = Gym::where('id', $gymsCollection[0]->city_id)->first();

        return view('coaches.edit', [
            'staff' => $staff,
            // 'gyms' => $gyms,
            'cities' => $cities,
            'gymsCollection' => $gymsCollection,
            'gymsCity' => $gymsCity

        ]);
    }

    public function show($id) {
        if (Auth::user()->hasRole('coach'))
            return view('coaches.show', ['coach' => Auth::user()]);

        $coach = Staff::find($id);
        return view('coaches.show', ['coach' => $coach]);
    }

    public function update($staffId , CoachRequest $request) {
        // print_r(request()->all()['avatar']);
        $requestData = request()->all();

        if (isset($requestData['avatar'])) {
            $imageName = time() . '.' . $requestData['avatar']->getClientOriginalName();
            $requestData['avatar']->move(public_path('images'), $imageName);
            $requestData['avatar'] = $imageName;
        } else {
            $imageName = Staff::find($staffId)->avatar;
        }

        Staff::find($staffId)->update($requestData);

        if (isset($requestData['gyms'])) {
            $gymIds = $requestData['gyms'];
            gymCoach::where('staff_id', $staffId)->delete();

            foreach ($gymIds as $gymId) {
                gymCoach::Create(
                    [
                        'staff_id' => $staffId,


                        'gym_id' => $gymId
                    ]
                );
            }
        }
        // $gym->gym_id = $requestData['gym'];
        // $gym->save();

        return redirect()->route('coaches.index');
    }
    //----------------------- create new member -------------------------
    public function create() {
        $cities = City::all();
        $gyms = Gym::all();
        return view(
            'coaches.create',
            [
                'cities' => $cities,
                'gyms' => $gyms,
            ]
        );
    }
    public function store(CityManagerRequest $request) {
        $requestData = request()->all();
        if (isset($requestData['avatar'])) {
            $imageName = time() . '.' . $requestData['avatar']->getClientOriginalName();
            $requestData['avatar']->move(public_path('images'), $imageName);
        } else {
            $imageName = 'user_avatar.png';
        }
        $gymIds = $requestData['gyms'];
        $coach = Staff::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'avatar' => $imageName,
            'national_id' => $requestData['national_id'],

        ]);
        $coach->assignRole('coach');
        $staffMember = Staff::where('name', $requestData['name'])->first();


        foreach ($gymIds as $gymId) {
            gymCoach::Create(
                [
                    'staff_id' => $staffMember->id,


                    'gym_id' => $gymId
                ]
            );
        }



        return redirect()->route('coaches.index');
    }
    //-------------------- delete member -------------------------------

    public function destroy(Request $request) {

        $member = Staff::where('id', $request->id)->delete();
        return Response()->json($member);
    }

    public function profile($id) {
        if (Auth::user()->hasRole('coach'))
            return view('coaches.profile', ['coach' => Auth::user()]);

        $coach = Staff::find($id);
        return view('coaches.profile', ['coach' => $coach]);
    }
    public function sessions($id) {
        // $coachSession = Staff::find($id)->coachSessions;
        // dd($coachSession);
        if (Auth::user()->hasRole('Super-Admin')) {
            $sessions = Session::with('gym')->get();
        } elseif (Auth::user()->hasRole('city_manager')) {

            $cityId = City::where('staff_id', Auth::user()->id)->first()['id'];
            $gymIds = Gym::where('city_id', $cityId)->pluck('id');
            $sessions = collect();
            foreach ($gymIds as $gymId) {
                $gymSessions = Session::where('gym_id', $gymId)->get();
                foreach ($gymSessions as $gymSession) {
                    $sessions->push($gymSession);
                };
            }
        } elseif (Auth::user()->hasRole('gym_manager')) {
            $gymId = GymManager::where('staff_id', Auth::user()->id)->first()['gym_id'];
            $sessions = Session::with('gym')->where('gym_id', $gymId)->get();
        }


        if (request()->ajax()) {
            return datatables()->of($sessions)
                ->addColumn('Coaches', function (Session $session) {
                    $coaches = $session->coaches->pluck('name'); //extract name keys from data

                    return count($coaches) > 0 ? $coaches->implode(' , ') : "None";
                })
                ->addColumn('gym', function (Session $session) {
                    //extract name keys from data

                    return $session->gym->name;
                })
                ->addColumn('city', function (Session $session) {
                    $cityId = $session->gym->city_id; //extract name keys from data

                    return City::find($cityId)->name;
                })

                ->addColumn('action', function ($data) {
                    $button = '<a
                onClick="EditSession(' . $data->id . ')"
                class="edit btn btn-primary btn-sm ">Edit</a>';

                    $button .= '<a
                onClick="DeleteSession(' . $data->id . ')"
                class="delete btn btn-danger btn-sm">Delete</a>';
                    return $button;
                })


                ->rawColumns(array('action')) //for cells have html
                ->make(true);
        }
        return view('coaches.sessions');
    }
    public function password($staffId) {

        
        return view('coaches.password',
    [
        'coachId' => $staffId,
    ]);
    }

    public function passwordUpdate(Request $request,$staffId)
    {
        $this->validate($request, [ 
            'old_password' => ['nullable'],
            'password' => ['min:6','max:20','nullable'],
            'confirm'=>['same:password','nullable'],
        ]);
        
        $hashedPassword = Staff::find($staffId)->password;
        if (Hash::check($request->oldpassword , $hashedPassword)) {
            
                $user = Staff::find($staffId);
                $user->password = bcrypt($request->password);
                $user->save();

           
        }
        else{
          return Redirect::back()->withErrors(['msg' => 'Wrong old password']);
        }
        return redirect()->route('coaches.show',$staffId);
    }
}