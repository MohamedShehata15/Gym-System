<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
     public function index()
    {
        //$users = User::all();
        if(request()->ajax())
        {
            return datatables()->of(User::latest()->get())
               ->addColumn('action',function($data)
               {
                   $button ='<button type="button"
                   name="add" id="'.$data->id.'"
                   class="btn btn-primary btn-sm">Add
                   </button>';
                   return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('users.index');
    }
}
