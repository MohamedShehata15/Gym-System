<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GymController extends Controller
{
    public function index(){
        // dd('@GymController->index');
        return view('gyms.index');
    }
    public function create(){
        dd('@GymController->create');
    }
}
