<?php

namespace App\Http\Controllers;
use App\Http\Requests\TrainingPackageRequest;
use App\Models\TrainingPackage;
use App\Models\Gym;
use App\Models\UserTrainingPackage;
use Illuminate\Http\Request;


class TrainingPackageController extends Controller
{
    public function index()
    {
        $trainingPackages = TrainingPackage::with('trainingPackageGym')->get();
        if(request()->ajax())
        {
            return datatables()->of($trainingPackages)
            ->addColumn('GymName',function(TrainingPackage $trainingPack)
            {
                return $trainingPack->trainingPackageGym->name;
            })
               ->addColumn('action',function($data)
               {
                $button ='<a href="'.route('training-packages.edit',$data->id).'" class="btn btn-info btn-sm mx-2">Edit</a>';
                $button .='<a href="javascript:void(0);" onClick = "deleteFunc('.$data->id.')"class="btn btn-danger btn-sm mx-2">Delete</a>';
                return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('training-packages.index');
    }
    //-------------------------- edit training package --------------------------------
    public function edit( $trainingId)
    {
        $trainingPackage = TrainingPackage::find($trainingId);
        $gyms = Gym::all();
        return view('training-packages.edit',[
            "trainingPackage" => $trainingPackage,
            "gyms" => $gyms,
        ]);
    }
    public function update($trainingId,TrainingPackageRequest $request)
    {
        $requestData = request()->all();
        $trainingPackage = TrainingPackage::find($trainingId)->update(['name' => $requestData['Name'],
        'price' => ($requestData['Price']/0.01),
        'session_number' => $requestData['sessionNum'],
        'gym_id' => $requestData['gym']]);
        return redirect()->route('training-packages.index');
    }
    //-------------------------- create training package --------------------------------
    public function create()
    {
        $gyms = Gym::all();
        return view('training-packages.create',[
            'gyms'=> $gyms
        ]);
    }
    public function store(TrainingPackageRequest $request)
    {
        $requestData = request()->all();
        TrainingPackage::create(['name' => $requestData['Name'],
        'price' => ($requestData['Price']/0.01),
        'session_number' => $requestData['sessionNum'],
        'gym_id' => $requestData['gym']]);
        return redirect()->route('training-packages.index');
    }
    //-------------------------- delete training package --------------------------------
    public function destroy(Request $request)
    {
        $recordedPackage =  UserTrainingPackage::where('training_package_id', $request->id)->get();

        if (count($recordedPackage) == 0){
            $trainingPackage = TrainingPackage::where('id', $request->id)->delete();
            return Response()->json($trainingPackage);
        }
    }
}
