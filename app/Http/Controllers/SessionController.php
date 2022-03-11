<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\GymCoaches;
use App\Models\User;
use App\Models\SessionUser;
use App\Models\SessionStaff;
use App\Http\Requests\SessionRequest;
use App\Models\City;
use App\Models\Gym;
use App\Models\GymManager;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller {
    public function index() {
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
                class="edit btn btn-primary btn-sm mx-2">Edit</a>';

                    $button .= '<a
                onClick="DeleteSession(' . $data->id . ')"
                class="delete btn btn-danger btn-sm">Delete</a>';
                    return $button;
                })


                ->rawColumns(array('action')) //for cells have html
                ->make(true);
        }
        return view('sessions.index');
    }

    public function create() {
        $coaches = Staff::role('coach')->get();
        return view('sessions.create', [
            'coaches' => $coaches
        ]);
    }


    public function store(SessionRequest $request) {
        $requestData = request()->all();

        $dataTimeStart = $requestData['day'] . " " . $requestData['start']; //concat date with time
        $dateTimeFinish = $requestData['day'] . " " . $requestData['finish'];

        $SessionIsExist = Session::where('start_at', '<=', $dataTimeStart)->where('finish_at', '>=', $dateTimeFinish)->exists();
        if (!$SessionIsExist) {
            $session = Session::create([
                'name' => $requestData['name'],
                'start_at' => $dataTimeStart,
                'finish_at' => $dateTimeFinish,
                'gym_id' => 2
            ]);

            $coaches = $requestData['coaches'];
            $coaches = array_values($coaches);
            $data = Staff::find($coaches);
            $session->coaches()->attach($data); //assign coaches to the session


            return redirect()->route('sessions.index');
        } else if ($SessionIsExist) {
            return  redirect()->back()->withErrors(['There is already session at this time :(']);
        }
    }

    public function destroy(Request $request) {
        $SomeoneAttend = SessionUser::where('session_id', '=', $request->id)->exists();
        if (!$SomeoneAttend) {
            $session = Session::where('id', $request->id)->delete();
            return (Response()->json($session));
        } else if ($SomeoneAttend) {
            return  redirect();
        }
    }


    public function edit(Request $request) {
        $coaches = Staff::role('coach')->pluck('name');
        $coachesid = Staff::role('coach')->pluck('id');
        $session = Session::find($request->id);
        $selectedCoaches = SessionStaff::where('session_id', '=', $session->id)->pluck('staff_id');

        $output = array(
            'name' => $session->name,
            'start_at' => $session->start_at,
            'finish_at' => $session->finish_at,
            'coaches' => $coaches,
            'coachesid' => $coachesid,
            'selectedCoaches' => $selectedCoaches
        );
        echo json_encode($output);
    }


    public function update(SessionRequest $request) {
        $requestData = request()->all();

        //check if any one attend this session 
        $SomeoneAttend = SessionUser::where('session_id', '=', $requestData['id'])->exists();
        $CurrentSession = Session::find($request->id);
        $startdate = $CurrentSession->start_at;
        $finishdate = $CurrentSession->finish_at;
        $changedStartDate = $requestData['day'] . " " . $requestData['start'];
        $changedFinishDate = $requestData['day'] . " " . $requestData['finish'];

        if (($changedStartDate != $startdate || $changedFinishDate != $finishdate) && $SomeoneAttend) {
            return  back()->withErrors(['There is people attend this session you cannot change the date :(']);
        } else {
            Session::where('id', $requestData['id'])->update([
                'name' => $requestData['name'],
                'start_at' => $requestData['day'] . " " . $requestData['start'],
                'finish_at' => $requestData['day'] . " " . $requestData['finish']
            ]);
            $coaches = $requestData['coaches'];
            $coaches = array_values($coaches);
            $data = Staff::find($coaches);
            $CurrentSession->coaches()->sync($data); //assign coaches to the session

            return redirect()->route('sessions.index');
        }
    }
}