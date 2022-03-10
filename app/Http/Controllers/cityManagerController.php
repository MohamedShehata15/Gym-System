<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityManagerController extends Controller {
    public function index() {
        if (Auth::user()->role == "city_manager") {
            $cityManagerId = Auth::user()->id;
            $cityGyms = Staff::find($cityManagerId)->city->gyms;
            return view('cityManagers.index', [
                'cityGyms' => $cityGyms
            ]);
        } else {
            dd("You aren't City Manager so you can't enter.. ");
        }
    }
    public function show() {
    }
    public function edit() {
    }
    public function store() {
    }
    public function update() {
    }
    public function create() {
    }
    public function destroy() {
    }
    public function ban($id) {
        $gymManager = Staff::where('id', $id)->first();
        $isBan = $gymManager->is_baned;
        $isBan == 0 ? $updatedBan = ['is_baned' => 1] :  $updatedBan = ['is_baned' => 0];
        Staff::where('id', $id)->update($updatedBan);
        return redirect()->route("cityManagers.index");
    }
}