<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class CityManagerController extends Controller
{
    public function index(){
        $cityManagers=Staff::where('role','city_manager')->get();
        return view('cityManagers.index',[   
            'cityManagers'=>$cityManagers,
        ]);
    }
    public function show(){
        
    }
    public function edit(){

    }
    public function store(){

    }
    public function update(){

    }
    public function create(){

    }
    public function destroy(){

    }
    public function ban($id){
        $cityManager=Staff::where('id',$id)->first();
        $isBan= $cityManager->is_baned;
        $isBan == 0 ? $updatedBan =[  'is_baned' => 1] :  $updatedBan =[  'is_baned' => 0 ];
        Staff::where('id',$id)->update($updatedBan);
        return redirect()->route("cityManagers.index");
    }
}
