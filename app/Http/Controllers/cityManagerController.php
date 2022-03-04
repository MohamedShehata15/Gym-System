<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\City;
use App\Models\Gym;

class cityManagerController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Staff::where('role','city_manager')->get())
               ->addColumn('action', function ($data) {
                   $button ='<a href="'.route('city-managers.edit',$data->id).'" class="btn btn-info btn-sm mx-2">Edit</a>';
                   $button .='<a href="javascript:void(0);" onClick = "deleteFunc('.$data->id.')"class="btn btn-danger btn-sm mx-2">Delete</a>';
                   return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('city-managers.index');
    }
    //--------------------------- edit staff member -----------------------
    public function edit($staffId)
    {
        //$staff = Staff::all();
        $staff = Staff::find($staffId);
        //$post = Post::find($postId);
            return view('city-managers.edit',[
                'staff' => $staff,
                //'users'=> $users
            ]);
    }
    public function update($postId)
    {
        $requestData = request()->all();
        $post = Post::find($postId)->update(['Title' => $requestData['Title'],
        'Description' => $requestData['Description'],
        'user_id' => $requestData['user_id']]);
        return redirect()->route('city-managers.index');
    }
    //----------------------- create new member -------------------------
    public function create()
    {
        $scities = City::all();
        // $gyms = Gym::all();
        return view('city-managers.create',
    [
        'cities' => $scities,
        // 'gyms' => $gyms,
    ]);
    }
    public function store()
    {
        $requestData = request()->all();
       
        Staff::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
            'avatar' => $requestData['avatar'],
            'national_id' => $requestData['national_id'],
            'is_baned' => 0,
            'role' => "city_manager",
        ]);
        $staffMember = Staff::where('name',$requestData['name'])->first();
        //dd($requestData['city']);
        $city = City::find($requestData['city']);
        $city->staff_id =  $staffMember->id;
        $city->save();
        return redirect()->route('city-managers.index');
    }
   //-------------------- delete member -------------------------------
   public function destroy(Request $request)
   {
    //    // get arrays of gyms where gym_manager = $request-id
    //          $gyms=Staff::find($request->id)->gymManger;
        //get the city  where city_manager=$request_id
             $city = Staff::find($request->id)->city;
        // //get arrays of sessions where coach_id=$request_id
        //     $sessions = Staff::find($request->id)->coachSessions;
    //    $is_valid=true ;
    //    if(isset($sessions) || isset($gyms))
    //    {
    //        $is_valid=false;
    //    }
       if(empty($city))
       {
           $cityManager = Staff::where('id', $request->id)->delete();
           return Response()->json($cityManager);
       }
       
   }
//    public function delete()
//    {
//        $gyms=Staff::find(51)->city;
//        dd(empty($gyms));
//    }
}
