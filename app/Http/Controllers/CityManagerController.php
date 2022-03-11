<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\City;


class CityManagerController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Staff::role('city_manager')->get())
               ->addColumn('action', function ($data) {
                   $button ='<a href="'.route('city-managers.edit',$data->id).'" class="btn btn-info btn-sm mx-2">Edit</a>';
                   $button .='<a href="javascript:void(0);" onClick = "deleteFunc('.$data->id.')"class="btn btn-danger btn-sm mx-2">Delete</a>';
                   return $button;
               })
               ->addColumn('city', function ($data) {
               $city = City::where('staff_id', '=', $data->id)->first();
               return $city? $city->name : "None";
            })
               ->rawColumns(['action'])->make(true);
        }
        return view('city-managers.index');
    }
    //--------------------------- edit staff member -----------------------
    public function edit($staffId)
    {
        
        $staff = Staff::find($staffId);
        $cities = City::all();
            return view('city-managers.edit',[
                'staff' => $staff,
                'cities' => $cities,
                
            ]);
    }
    public function update($staffId)
    {
        $requestData = request()->all();
        Staff::find($staffId)->update([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
            'avatar' => $requestData['avatar'],
            'national_id' => $requestData['national_id'],
            'is_baned' => 0,
            
        ]);
        City::where('staff_id',$staffId)->first()->update([
            'staff_id' => NULL
        ]);
        $city = City::find($requestData['city']);
        $city->staff_id =  $staffId;
        $city->save();

        return redirect()->route('city-managers.index');
    }
    //----------------------- create new member -------------------------
    public function create()
    {
        $scities = City::all();
        return view('city-managers.create',
    [
        'cities' => $scities,
    ]);
    }
    public function store()
    {
        $requestData = request()->all();
       
        $cityManager= Staff::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
            'avatar' => $requestData['avatar'],
            'national_id' => $requestData['national_id'],
            'is_baned' => 0,
            
        ]);
        $cityManager->assignRole('city_manager');
        $staffMember = Staff::where('name',$requestData['name'])->first();
        
        $city = City::find($requestData['city']);
        $city->staff_id =  $staffMember->id;
        $city->save();
        return redirect()->route('city-managers.index');
    }
   //-------------------- delete member -------------------------------
   public function destroy(Request $request)
   {
       
           $member = Staff::where('id', $request->id)->delete();
           return Response()->json($member);
       
       
   }

}