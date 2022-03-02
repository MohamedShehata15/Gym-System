<?php

namespace App\Http\Controllers;
use App\Models\TrainingPackage;
use Illuminate\Http\Request;


class TrainingPackageController extends Controller
{
    public function index()
    {
        
        if(request()->ajax())
        {
            return datatables()->of(TrainingPackage::latest()->get())
               ->addColumn('action',function($data)
               {
                   $button ='<button type="button"
                   name="add" id="'.$data->id.'"
                   class="btn btn-primary btn-sm">Add
                   </button>';
                   return $button;
               })
               ->rawColumns(['action'])->make(true);
        }
        return view('training-package.index');
    }
}
