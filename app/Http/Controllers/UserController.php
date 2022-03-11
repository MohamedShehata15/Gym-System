<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gym;

class UserController extends Controller
{
     public function index()
    { 
        if(request()->ajax())
        {
            return datatables()->of(User::get())
            ->addColumn('gym',function($data)
            {
                $trainingPack = User::find($data->id)->trainingPackage;
                if(empty($trainingPack[0]))
                {
                    return ('none');
                }
                else
                {
                    $gymId = $trainingPack[0]->gym_id;
                    return (Gym::find($gymId )->name);
                }
            })
            ->addColumn('action',function($data)
            {
             $button ='<a href="'.route('users.edit',$data->id).'" class="btn btn-info btn-sm ">Edit</a>';
             $button .='<a href="javascript:void(0);" onClick = "deleteFunc('.$data->id.')"class="btn btn-danger btn-sm mx-1">Delete</a>';
             return $button;
            })
               ->rawColumns(['action'])->make(true);
        }
        return view('users.index');
    }
//-------------------------- edit user --------------------------------
    public function edit( $userId)
    {
        $user = User::find($userId);
        $gyms = Gym::all();
        return view('users.edit',[
            "user" => $user,
            "gyms" => $gyms,
        ]);
    }
    public function update($userId)
    {
        $requestData = request()->all();
        if(isset($requestData['avatar']))
        {
             $imageName = time().'.'.$requestData['avatar']->getClientOriginalName(); 
             $requestData['avatar']->move(public_path('images'), $imageName);
        }
        else{
            $imageName = User::find($staffId)->avatar;
        }
        // $requestData['avatar']->validate([
        //     'avatar' => 'required|mimes:jpeg,png,jpg|max:2048']);
        $user = User::find($userId)->update(['name' => $requestData['Name'],
        'email' => $requestData['Email'],
        'gender' => $requestData['Gender'],
        'avatar' => $imageName]);
        return redirect()->route('users.index');
    }
//-------------------------- delete user --------------------------------
   public function destroy(Request $request)
   {
       $user = User::where('id',$request->id)->delete();
       return Response()->json($user);
   }
}
