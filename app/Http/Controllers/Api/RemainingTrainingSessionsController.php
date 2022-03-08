<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use App\Models\UserSession;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class RemainingTrainingSessionsController extends Controller
{
    public function show()
    {
        $user = User::find(10);
        $sessions_info = [];
        $user_session = $user->sessions;

        foreach ($user_session as $session) {
            $session_info = [];
            $session_info['gym_name'] = $user->trainingPackage[0]->trainingPackageGym->name;
            $session_info['session_name'] = $session->name;
            $session_info['attendance_date'] = Carbon::create($session->start_at)->toDateString();
            $session_info['attendance_time'] = Carbon::create($session->start_at)->toTimeString();
            array_push($sessions_info, $session_info);
        }

        // return response()->json($sessions_info);
        return $sessions_info;
    }

    //==========================================================================================//

    public function remainingSession()
    {
        $user = User::find(2);
        $total_session = $user->trainingPackage;
        $remaining_sessions = $user->attendance_session;
        $total = 0;
        foreach ($total_session as $package) {
            $total += $package->session_number;
        }
        return ['total_sessions' => $total, 'remaining_sessions' => $remaining_sessions];
    }

    //==========================================================================================//

    public function attendSession($id)
    {
        $session = Session::find($id);
        $now     = Carbon::now();
        $user    = User::find(2);

        $start = $session->start_at;
        $finish = $session->finish_at;

        $user_session = UserSession::where('user_id', $user->id)->where('session_id', $session->id)->get();

        if ($user_session->first()) {
            throw ValidationException::withMessages([
                'you attended the session before'
            ]);
        }
        if ($start <= $now && $finish >= $now && $user->attendance_session > 0) {

            UserSession::create([
                'session_id' => $session->id,
                'user_id' => $user->id
            ]);
            $user->update([
                'attendance_session' => ($user->attendance_session - 1)
            ]);

            return ['SuccessMessage' => 'you can attend training session'];
        } else {

            throw ValidationException::withMessages([
                'you need to buy training sessions in order to attend'
            ]);
        }
    }

    //==========================================================================================//

}
