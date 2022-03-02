<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\DataTables\CityDataTable;

class CityController extends Controller
{


    public function index(CityDataTable $dataTable){
    
        return $dataTable->render('cities.index');
    }

}
