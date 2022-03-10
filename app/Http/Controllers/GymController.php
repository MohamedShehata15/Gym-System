<?php

namespace App\Http\Controllers;

use App\Http\Requests\GmyRequest;
use App\Models\City;
use App\Models\SessionStaff;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\Session;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class GymController extends Controller
{

//----------------------index--------------------//
    public function index(){
        $gyms=Gym::with('city')->get();
       
        if(request()->ajax()){
            return Datatables()->of($gyms)->addIndexColumn()
            ->addColumn('action',function($data){
                    $actionBtn = '<a href="'.route('gyms.show', $data->id).'"  class="show btn btn-info btn-sm">Show</a>
                                 <a onClick="editFunc('.$data->id.')" class="edit btn btn-warning btn-sm">Edit</a>
                                 <a onClick="DeleteGym('.$data->id.')" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
            })
            ->addColumn('cityManager', function (Gym $gym) {
                return $gym->city->cityManager->name;
            })
            ->addColumn('created_at', function ($gym) {
                return $gym->created_at->format('Y-M-D');
            })
            ->addColumn('gymImage', function (Gym $gym) {
                $imageGym='<img src="../uploads/gyms/'.$gym->image.'" alt="notFounded" class="rounded-circle shadow"/>';
                return $imageGym;
                // $url= url("storage/uploads/users/".$gym->image. "");
                // return '<img src="'. $url .'" alt="notFounded" class="rounded-circle shadow/>';
            })
                ->rawColumns(['action'])
                ->make(true);
         }
         return view('gyms.index',[
         'gyms' => $gyms,
        ]);
        
    }
//----------------------create--------------------//
    public function create(){
        $staff=Staff::role('gym_manager');                            //to return array
        $cities=City::all();
        return view('gyms.create',[
            'staff' => $staff ,
            'cities' => $cities
        ]); 
    }
//----------------------getImageData--------------------//
    public function getImageData($imageData){
        $file = $imageData->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = time().'.'.$extenstion;
        $file->move('uploads/gyms/', $filename);
        return $filename;
    }
//----------------------store--------------------//
    public function store(GmyRequest $request){
        $gymData = request()->all();
        $fileName=$this->getImageData($request);
        $newGym=Gym::create([
            'name'=>$gymData['name'],          
            'revenue'=>0,
            'image'=> $fileName  ,
            'city_id'=> $gymData['city_id']         
        ]);
    
        GymManager::create([                                              
            "staff_id"=>$gymData['staff_id'],
            "gym_id"=>$newGym->id
        ]);
        return redirect()->route("gyms.index");
    }
//----------------------Show--------------------//
    public function show($id){
        $gym=Gym::find($id);
        $managers=Gym::find($id)->gymManager;
        return view('gyms.show',[
            'gym' => $gym,
            'managers' =>$managers
        ]); 
    }
//----------------------edit--------------------//
    public function edit($id){
        $gym=Gym::find($id);
        $staff=Staff::role('gym_manager');  //gymManager             //return array of names   
        $cities=City::all();   //cityManager
        $citieManagers=$cities->cityManager->get();
        $output=array(
           'citieManagers'=>$citieManagers,
           'gymManagers'=>$staff,
            'gym'=> $gym->name
        );
        echo json_encode($output);

    }
//----------------------update--------------------//
    public function update($id ,GmyRequest $request){
        $gym=Gym::find($id);
        $fileName=$this->getImageData($request);
        $updatedGymData=[
            'name'=>$request['name'],          
            'image'=> $fileName  ,
            'city_id'=> $request['city_id'] ,        
        ];
        $updatedGymManagerData=[

            "staff_id"=>$request['staff_id']
        ];
        Gym::where('id',$gym->id)->update($updatedGymData); 
        GymManager::where('gym_id',$gym->id)->update($updatedGymManagerData);        
        return redirect()->route("gyms.index");
    }
    //----------------------destroy--------------------//
    public function destroy(Request $request){ 
       $flag=0;
       $gymCoaches= Gym::find($request->id)->gymCoaches;
        foreach($gymCoaches as $gymCoache){
            $gymSession= SessionStaff::where('staff_id',$gymCoache->id)->get();
            if($gymSession != NULL){
                $flag=1;
            }
        }
        if($flag==0){
            $gym=Gym::find($request->id)->delete();
            return (Response()->json($gym));
        }else{
            return redirect()->route("gyms.index");
        }
    }

}