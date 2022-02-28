<?php

namespace App\Http\Controllers;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\GymCoaches;


class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::all();     
        return view('sessions.index', [
            'sessions' => $sessions,
        ]);

    }

    public function create()
    {
        $coaches=GymCoaches::all();
        return view('sessions.create', [
            'coaches' =>$coaches
        ]);
    }
 
}
