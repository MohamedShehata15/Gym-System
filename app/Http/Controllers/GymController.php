<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\User;
use Illuminate\Http\Request;

class GymController extends Controller
{
    public function index(){
        $gyms=Gym::all();
        return view('gyms.index',[   
            'gyms'=>$gyms
        ]);
    }

    public function create(){
        $users=User::all();
        return view('gyms.create',[
            'users' => $users
        ]); 
    }

    public function store(){
        $gymData = request()->all();

        // $imageName = time()."_".$gymData->image->originalName;
        // // dd($imageName);
        // $gymData->image->move(public_path('uploads'), $imageName);

        Gym::create([
            'name'=>$gymData['name'],
            'staffs_id'=>$gymData['staffs_id'],            
            'image'=>$gymData['image'],
            'revenue'=>0,            
        ]);
        // Gym::create($gymData);
        return redirect()->route("gyms.index");
    }

    public function show($id){
        $gym=Gym::find($id);
        return view('gyms.show',[
            'gym' => $gym
        ]); 
    }

    public function edit($id){
        $gym=Gym::find($id);
        $users = User::all();
        return view('gyms.edit',[
            'gym' => $gym ,
            'users' => $users
        ]); 
    }

    public function update($id){
        $gym=Gym::find($id);
        $updatedData = request()->all();
        unset($updatedData['_token']);
        unset($updatedData['_method']);
        Gym::where('id',$gym->id)->update($updatedData);         
        return redirect()->route("gyms.index");
    }
    
    public function destroy($id){
        dd($id);
        Gym::find($id)->delete();
        return redirect()->route("gyms.index");
    }


}
