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
                   $button ='<button type="button"
                   name="add" id="'.$data->id.'"
                   class="btn btn-primary btn-sm">Add
                   </button>';
                   return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('cities.index');
    }
}
