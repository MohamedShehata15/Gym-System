<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        
        if(request()->ajax())
        {
            return datatables()->of(City::latest()->get())
               ->addColumn('action',function($data)
               {
                   $button ='<a href="'.route('cities.show',$data->id).'" class="btn btn-primary btn-sm mx-4">Update</a>';
                   $button .='<a href="'.route('cities.delete',$data->id).'" class="btn btn-danger btn-sm mx-4">Delete</a>';
                  
                   return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('cities.index');
    }

    public  function show(){

        return "sayed";
    }

}
