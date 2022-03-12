<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\City;
use App\Http\Requests\CityManagerRequest;


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
    public function update($staffId , CityManagerRequest $request)
    {
        $requestData = request()->all();
        if(isset($requestData['avatar']))
        {
             $imageName = time().'.'.$requestData['avatar']->getClientOriginalName(); 
             $requestData['avatar']->move(public_path('images'), $imageName);
        }
        else{
            $imageName = Staff::find($staffId)->avatar;
        }
        Staff::find($staffId)->update([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
            'avatar' => $imageName,
            'national_id' => $requestData['national_id'],
            
        ]);
        $oldCity = City::where('staff_id',$staffId)->first();
        if(!empty($oldCity))
        {
            $oldCity->update([
                'staff_id' => NULL
            ]);
        }
       
        $city = City::find($requestData['city']);
        $city->staff_id =  $staffId;
        $city->save();

        return redirect()->route('city-managers.index');
    }
    //----------------------- create new member -------------------------
    public function create()
    {
    
        $cities = City::all();
        return view('city-managers.create',
    [
        'cities' => $cities,
    ]);
    }
    public function store(CityManagerRequest $request)
    {
        $requestData = request()->all();
        if(isset($requestData['avatar']))
        {
             $imageName = time().'.'.$requestData['avatar']->getClientOriginalName(); 
             $requestData['avatar']->move(public_path('images'), $imageName);
        }
        else{
            $imageName = 'user_avatar.png';
        }
        $cityManager= Staff::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
            'avatar' =>  $imageName,
            'national_id' => $requestData['national_id'],
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