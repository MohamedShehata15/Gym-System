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

class GymController extends Controller {

    //----------------------index--------------------//
    public function index() {
        $gyms = Gym::all();
        return view('gyms.index', [
            'gyms' => $gyms,
        ]);
    }
    //----------------------create--------------------//
    public function create() {
        $staff = Staff::where("role", "gym_manager")->get();                            //to return array
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
        $newGym = Gym::create([
            'name' => $gymData['name'],
            'revenue' => 0,
            'image' => $fileName,
            'city_id' => $gymData['city_id']
        ]);

        GymManager::create([
            "staff_id" => $gymData['staff_id'],
            "gym_id" => $newGym->id
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
        $staff = Staff::where("role", "gym_manager")->get();
        $cities = City::all();
        return view('gyms.edit', [
            'gym' => $gym,
            'staff' => $staff,
            'cities' => $cities
        ]);
    }
    //----------------------update--------------------//
    public function update($id, GmyRequest $request) {
        $gym = Gym::find($id);
        $fileName = $this->getImageData($request);
        $updatedGymData = [
            'name' => $request['name'],
            'image' => $fileName,
            'city_id' => $request['city_id'],
        ];
        $updatedGymManagerData = [

            "staff_id" => $request['staff_id']
        ];
        Gym::where('id', $gym->id)->update($updatedGymData);
        GymManager::where('gym_id', $gym->id)->update($updatedGymManagerData);
        return redirect()->route("gyms.index");
    }
    //----------------------destroy--------------------//
    public function destroy($id) {
        $flag = 0;
        $gymCoaches = Gym::find($id)->gymCoaches;
        foreach ($gymCoaches as $gymCoache) {
            $gymSession = SessionStaff::where('staff_id', $gymCoache->id)->get();
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
}