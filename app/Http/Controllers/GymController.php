<?php

namespace App\Http\Controllers;

use App\Http\Requests\GmyRequest;
use App\Models\City;
use App\Models\Gym;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use App\Models\UserCoachSession;
use Illuminate\Support\Facades\Auth;

class GymController extends Controller {

//----------------------index--------------------//
    public function index(){
        $gyms=Gym::with('city')->get();
       
        if(request()->ajax()){
            return Datatables()->of($gyms)->addIndexColumn()
            ->addColumn('action',function($data){
                    $actionBtn = '<a href="'.route('gyms.show', $data->id).'"  class="show btn btn-info btn-sm">Show</a>
                                 <a onClick="editFunc(' . $data->id . ')" class="edit btn btn-warning btn-sm">Edit</a>
                                 <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    
                                 return $actionBtn;
            })
            ->addColumn('cityManager', function (Gym $gym) {
                return $gym->city->cityManager->name;
            })
            ->addColumn('gymImage', function (Gym $gym) {
                // $imageGym=<img src="../uploads/gyms/{{$gym->image}}" alt="notFounded" class="rounded-circle shadow"/>
                // <img src="../uploads/gyms/{{$gym->image}}" alt="notFounded" class="rounded-circle shadow"/>
                return $gym->image;
            })
                ->rawColumns(['action'])
                ->make(true);
         }
         return view('gyms.index',[
         'gyms' => $gyms,
        ]);
        
    }
    //----------------------create--------------------//
    public function create() {
        $staff = Staff::role("gym_manager")->get();                            //to return array
        $cities = City::all();
        return view('gyms.create', [
            'staff' => $staff,
            'cities' => $cities
        ]);
    }
    //----------------------getImageData--------------------//
    public function getImageData($imageData) {
        $file = $imageData->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extenstion;
        $file->move('uploads/gyms/', $filename);
        return $filename;
    }
    //----------------------store--------------------//
    public function store(GmyRequest $request) {
        $gymData = request()->all();
        $fileName = $this->getImageData($request);
        $createdBy = Auth::user()-> hasRole('city_manager') ? Auth::user()->name : "Admin";
    
        //dd($createdBy);
        Gym::create([
            'name' => $gymData['name'],
            'revenue' => 0,
            'image' => $fileName,
            'city_id' => Auth::user()->hasRole('city_manager') ? City::where('staff_id',Auth::user()->id)->first()->id : $gymData['city_id'],
            'created_by' => $createdBy
        ]);

        return redirect()->route("gyms.index");
    }
    //----------------------Show--------------------//
    public function show($id) {
        $gym = Gym::find($id);
        $managers = Gym::find($id)->gymManager;
        return view('gyms.show', [
            'gym' => $gym,
            'managers' => $managers
        ]);
    }
//----------------------edit--------------------//
    public function edit(Request $request){
        $gym=Gym::find($request->id);
        $staff=Staff::select('name')->get()->pluck('name');; //gymManager     
        $citiesNames=City::select('name')->get()->pluck('name'); //city names   
        $output=array(
            'gym'=> $gym->name,
            'cities'=>$citiesNames,
            'gymManagers'=>$staff
        );
        echo json_encode($output);

    }
    //----------------------update--------------------//
    public function update($id, GmyRequest $request) {
        $gym = Gym::find($id);
        $gymData = request()->all();
        $fileName = $this->getImageData($request);
        $updatedGymData = [
            'name' => $request['name'],
            'image' => $fileName,
            'city_id' => Auth::user()-> hasRole('city_manager') ? City::where('staff_id',Auth::user()->id)->first()->id :$gymData['city_id'],
        ];
        Gym::where('id', $gym->id)->update($updatedGymData);
        return redirect()->route("gyms.index");
    }
    //----------------------destroy--------------------//
    public function destroy($id) {
        $flag = 0;
        $gymCoaches = Gym::find($id)->gymCoaches;
        foreach ($gymCoaches as $gymCoach) {
            $gymSession = UserCoachSession::where('staff_id', $gymCoach->id)->get();
            if ($gymSession != NULL) {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            Gym::find($id)->delete();
            return redirect()->route("gyms.index");
        } else {
            Session(['fail' => "You Can't Delete this GYM it had a sessions."]);
            return redirect()->route("gyms.index");
        }
    }

    //----------------------Get Gym users--------------------//
    public function users($id) {
        $users = Gym::find($id)->users->all();
        return $users;
    }

    //----------------------Get Gym Packages--------------------//
    public function packages($id) {
        $packages = Gym::find($id)->trainingPackages->all();
        return $packages;
    }
}