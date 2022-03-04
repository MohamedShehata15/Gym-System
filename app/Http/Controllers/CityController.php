<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Staff;
use App\Models\Gym;

class CityController extends Controller
{
    public function index()
    {
        $cities= City::with('cityManager')->get();
       
        if (request()->ajax()) {
            return datatables()->of($cities)
               ->addColumn('cityManagers', function (City $city) {
            return $city->cityManager->name;
        })
               ->addColumn('action', function ($data) {
                   $button ='<a href="javascript:void(0)" onClick = "editFunc('.$data->id.')"class="btn btn-info btn-sm mx-4">Edit</a>';
                   $button .='<a href="javascript:void(0);" onClick = "deleteFunc('.$data->id.')"class="btn btn-danger btn-sm mx-4">Delete</a>';
                   return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view(
            'cities.index',
            [
        'cities' => $cities,
        
    ]
        );
    }
//--------------------------- add new city -----------------------------
    public function store(Request $request)
    {
        $cityId = $request->id;
        
        $city   =   City::updateOrCreate(
            [
                     'id' => $cityId
                    ],
            [
                    'name' => $request->name,
                    'staff_id' => 1,
                    
                    ]
        );
                         
        return Response()->json($city);
    }
//--------------------- Edit name of city ------------------------------
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $city  = City::where($where)->first();
      
        return Response()->json($city);
    }
//-----------------------  delete city -------------------------------------
    public function destroy(Request $request)
    {
        $gyms = City::find($request->id)->gyms;
        $gymnumber =0 ;
        foreach($gyms as $gym)
        {
            if(!empty($gym))
            $gymnumber += 1;
        }
        if($gymnumber==0)
        {
            $city = City::where('id', $request->id)->delete();
            return Response()->json($city);
        }
        
    }
}