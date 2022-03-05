<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\City;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\GymCoach;

class coachController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Staff::where('role','coach')->get())
               ->addColumn('action', function ($data) {
                   $button ='<a href="'.route('coaches.edit',$data->id).'" class="btn btn-info btn-sm mx-2">Edit</a>';
                   $button .='<a href="javascript:void(0);" onClick = "deleteFunc('.$data->id.')"class="btn btn-danger btn-sm mx-2">Delete</a>';
                   return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('coaches.index');
    }
    //--------------------------- edit staff member -----------------------
    public function edit($staffId)
    {
        $cities = City::all();
        $gyms = Gym::all();
        $staff = Staff::find($staffId);
        $coachedGyms = gymCoach::where('staff_id',$staffId)->get();
        
        $gymsCollection = collect([]);
       
        foreach ($coachedGyms as $coachedGym)
        {  
            $gym = Gym::find($coachedGym->gym_id);     
            $gymsCollection->push($gym);
            
        }

        //dd($gymsCollection[0]);
         $gymsCity = Gym::where('id',$gymsCollection[0]->city_id)->first();
        
            return view('coaches.edit',[
                'staff' => $staff,
                'gyms' => $gyms,
                'cities' => $cities,
                'gymsCollection' => $gymsCollection,
                'gymsCity' => $gymsCity
                
            ]);
    }
    public function update($staffId)
    {
        $requestData = request()->all();
        $post = Staff::find($staffId)->update([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
            'avatar' => $requestData['avatar'],
            'national_id' => $requestData['national_id'],
            'is_baned' => 0,
            'role' => "coach",
        ]);


        $gymIds= $requestData['gyms'];
        gymCoach::where('staff_id', $staffId)->delete();
        
        foreach ($gymIds as $gymId) {
            gymCoach::Create(
                [  'staff_id' => $staffId,
                  
              
                  'gym_id' => $gymId
              ]
            );
        }
        // $gym->gym_id = $requestData['gym'];
        // $gym->save();

        return redirect()->route('coaches.index');
    }
    //----------------------- create new member -------------------------
    public function create()
    {
        $cities = City::all();
        $gyms = Gym::all();
        return view('coaches.create',
    [
        'cities' => $cities,
        'gyms' => $gyms,
    ]);
    }
    public function store()
    {
        $requestData = request()->all();
        $gymIds= $requestData['gyms'];
        Staff::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
            'avatar' => $requestData['avatar'],
            'national_id' => $requestData['national_id'],
            'is_baned' => 0,
            'role' => "coach",
        ]);
        $staffMember = Staff::where('name',$requestData['name'])->first();
        
       
        foreach ($gymIds as $gymId) {
            gymCoach::Create(
                [  'staff_id' => $staffMember->id,
                  
              
                  'gym_id' => $gymId
              ]
            );
        }
       

        
        return redirect()->route('coaches.index');
    }
   //-------------------- delete member -------------------------------
   
   public function destroy(Request $request)
   {
       
           $member = Staff::where('id', $request->id)->delete();
           return Response()->json($member);
       
       
   }

}
