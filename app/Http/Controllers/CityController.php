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
                $button ='<a href="javascript:void(0)" onClick = "deleteFunc('.$data->id.')"class="btn btn-info btn-sm mx-4">Edit</a>';
                $button .='<a href="javascript:void(0);" onClick = "deleteFunc('.$data->id.')"class="btn btn-danger btn-sm mx-4">Delete</a>';
                return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('cities.index');
    }

    public function destroy(Request $request)
    {
        $city = City::where('id',$request->id)->delete();  
        return (Response()->json($city));
    }

}
