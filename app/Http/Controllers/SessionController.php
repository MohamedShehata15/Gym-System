<?php

namespace App\Http\Controllers;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\GymCoaches;
use App\DataTables\SessionDataTable;


class SessionController extends Controller
{
    public function index()
     {
         if (request()->ajax()) {
             return datatables()->of(Session::latest()->get())
             ->addColumn('action', function ($data) {
                $button='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ';
                 $button.='<button type="button"
                name="edit" id="'.$data->id.'"
                class="edit btn btn-primary">Edit</button>';

                $button.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $button.='<button type="button"
                name="delete" id="'.$data->id.'"
                class="edit btn btn-danger">Delete</button>';
                 return $button;
             })
             ->rawColumns(['action'])
             ->make(true);
         }
         return view('sessions.index');
         //return $dataTable->render('sessions.index');
    //     $sessions = Session::all();
    // return view('sessions.index', [
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
