<?php

namespace App\Http\Controllers;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\GymCoaches;
use App\DataTables\SessionDataTable;


class SessionController extends Controller
{
    public function index(SessionDataTable $dataTable)
     {
         return $dataTable->render('sessions.index');
    //     $sessions = Session::all();     
    //     return view('sessions.index', [
    //         'sessions' => $sessions,
    //     ]);


    }

    public function create()
    {
        $coaches=GymCoaches::all();
        return view('sessions.create', [
            'coaches' =>$coaches
        ]);
    }
 
}
