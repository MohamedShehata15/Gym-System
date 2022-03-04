<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Staff::latest()->get())
               ->addColumn('action', function ($data) {
                   $button ='<a href="'.route('staff.edit',$data->id).'" class="btn btn-info btn-sm mx-2">Edit</a>';
                   $button .='<a href="javascript:void(0);" onClick = "deleteFunc('.$data->id.')"class="btn btn-danger btn-sm mx-2">Delete</a>';
                   return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('staff.index');
    }
    //--------------------------- edit staff member -----------------------
    public function edit($staffId)
    {
        //$staff = Staff::all();
        $staff = Staff::find($staffId);
        //$post = Post::find($postId);
            return view('staff.edit',[
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
        return redirect()->route('posts.index');
    }
    //----------------------- create new member -------------------------
    public function create()
    {
        //$staff = User::all();
        return view('staff.create');
    }
    public function store(StorePostRequest $request)
    {
        $requestData = request()->all();
        //$validated = $request->validated();
        //$validated = $request->safe()->only(['Title', 'Description']);
        Post::create($requestData);
        return redirect()->route('posts.index');
    }
   //-------------------- delete member -------------------------------
   public function destroy(Request $request)
   {
       // get arrays of gyms where gym_manager = $request-id
             $gyms=Staff::find($request->id)->gymManger;
        //get the city  where city_manager=$request_id
             $city = Staff::find($request->id)->city;
        //get arrays of sessions where coach_id=$request_id
            $sessions = Staff::find($request_id)->coachSessions;
       $is_valid=0 ;
       if(isset($sessions) || isset($gyms))
       {
           $is_valid=1;
       }
       if($is_valid==0 && empty($city))
       {
           $member = Staff::where('id', $request->id)->delete();
           return Response()->json($member);
       }
       
   }
//    public function delete()
//    {
//        $gyms=Staff::find(51)->city;
//        dd(empty($gyms));
//    }
}
