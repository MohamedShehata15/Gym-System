<?php

namespace App\Http\Controllers;

use App\Http\Requests\GmyRequest;
use App\Models\City;
use App\Models\Gym;
use App\Models\Staff;
use App\Models\TrainingPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Json;

class GymController extends Controller {

    //----------------------index--------------------//
    public function index() {
        $gyms = Gym::with('city')->get();
        if (request()->ajax()) {
            return Datatables()->of($gyms)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="' . route('gyms.show', $data->id) . '"  class="show btn btn-info btn-sm">Show</a>
                                 <a onClick="editFunc(' . $data->id . ')" class="edit btn btn-warning btn-sm">Edit</a>
                                 <a onClick="DeleteGym(' . $data->id . ')" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('cityManager', function (Gym $gym) {
                    return $gym->city->cityManager->name;
                })
                ->addColumn('created_at', function ($gym) {
                    return $gym->created_at->format('Y-M-D');
                })
                ->addColumn('gymImage', function (Gym $gym) {
                    $imageGym = '<img src="../uploads/gyms/' . $gym->image . '" alt="notFounded" class="rounded-circle shadow"/>';
                    return $imageGym;
                })
                ->rawColumns(['gymImage', 'action'])
                ->make(true);
        }
        return view('gyms.index', [
            'gyms' => $gyms,
        ]);
    }
    //----------------------create--------------------//
    public function create() {
        $staff = Staff::role('gym_manager')->get();                            //to return array
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
        $createdBy = Auth::user()->hasRole('city_manager') ? Auth::user()->name : "Admin";

        //dd($createdBy);
        Gym::create([
            'name' => $gymData['name'],
            'revenue' => 0,
            'image' => $fileName,
            'city_id' => Auth::user()->hasRole('city_manager') ? City::where('staff_id', Auth::user()->id)->first()->id : $gymData['city_id'],
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
    public function edit($id) {
        $gym = Gym::find($id);
        $staff = Staff::role('gym_manager')->get();  //gymManager             //return array of names   
        $citieManagers = Staff::role('city_manager')->get();  //gymManager             //return array of names   
        $output = array(
            'citieManagers' => $citieManagers,
            'gymManagers' => $staff,
            'gym' => $gym->name
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
            'city_id' => Auth::user()->hasRole('city_manager') ? City::where('staff_id', Auth::user()->id)->first()->id : $gymData['city_id'],
        ];
        Gym::where('id', $gym->id)->update($updatedGymData);
        return redirect()->route("gyms.index");
    }
    //----------------------destroy--------------------//
    public function destroy(Request $request) {
        $flag = 0;
        $gymCoaches = Gym::find($request->id)->gymCoaches;
        foreach ($gymCoaches as $gymCoache) {
            $gymSession = SessionStaff::where('staff_id', $gymCoache->id)->get();
            if ($gymSession != NULL) {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            $gym = Gym::find($request->id)->delete();
            return (Response()->json($gym));
        } else {
            return redirect()->route("gyms.index");
        }
    }

    //----------------------Get gym users--------------------//
    public function users($gymId) {
        $users = User::where('gym_id', $gymId)->get();
        return response()->json(['users' => $users]);
    }
    //----------------------Get gym Packages--------------------//
    public function packages($gymId) {
        $packages = TrainingPackage::where('gym_id', $gymId)->get();
        return response()->json(['packages' => $packages]);
    }
}