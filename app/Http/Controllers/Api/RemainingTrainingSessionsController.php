<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use App\Models\UserCoachSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class RemainingTrainingSessionsController extends Controller
{
    //SHOW ATTENDANCE HISTORY:
    public function show(Request $request)
    {

        $user = User::where('remember_token', explode(" ", $request->header()['authorization'][0])[1])->get()->first();
        $sessions_info = [];
        $user_session = $user->sessions;

        foreach ($user_session as $session) {
            $session_info = [];
            $session_info['gym_name'] = $session->gym->name;
            $session_info['session_name'] = $session->name;
            $session_info['attendance_date'] = Carbon::create($session->start_at)->toDateString();
            $session_info['attendance_time'] = Carbon::create($session->start_at)->toTimeString();
            array_push($sessions_info, $session_info);
        }
        return response()->json($sessions_info);
    }

    //==========================================================================================//

    //SHOWING REMAINING SESSIONS:
    public function remainingSession(Request $request)
    {
        $user = User::where('remember_token', explode(" ", $request->header()['authorization'][0])[1])->get()->first();
        // dd($user);
        $total_session = $user->trainingPackage;
        $remaining_sessions = $user->remaining_sessions;
        $total = 0;
        foreach ($total_session as $package) {
            $total += $package->session_number;
        }
        return ['total_sessions' => $total, 'remaining_sessions' => $remaining_sessions];
    }

    //==========================================================================================//

    //SHOWING ATTENDANCE SESSIONS
    public function attendSession(Request $request, $id)
    {
        $session = Session::find($id);
        $now     = Carbon::now();
        $user    = User::where('remember_token', explode(" ", $request->header()['authorization'][0])[1])->get()->first();

        $start = $session->start_at;
        $finish = $session->finish_at;

        $user_session = UserCoachSession::where('user_id', $user->id)->where('session_id', $session->id)->get();
        
        if ($user_session->first()) {
            throw ValidationException::withMessages([
                'you attended the session before'
            ]);
        }

        if($user->remaining_sessions > 0){

            if ($start <= $now && $finish >= $now) {
    
                UserCoachSession::create([
                    'session_id' => $session->id,
                    'user_id' => $user->id,
                    'staff_id' => 10
                ]);
                $user->update([
                    'remaining_sessions' => ($user->remaining_sessions - 1)
                ]);
    
                return ['SuccessMessage' => 'you can attend training session'];
        }else{
            throw ValidationException::withMessages([
                "Session is out of date"
            ]);
        }
        } else {

            throw ValidationException::withMessages([
                'you need to buy training sessions in order to attend'
            ]);
        }
    }

    //==========================================================================================//

}
