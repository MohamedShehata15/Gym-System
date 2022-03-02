<?php

use App\Models\City;
use App\Models\Gym;
use App\Models\Session;
use App\Models\Staff;
use App\Models\TrainingPackage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TrainingPackageController;
use App\Http\Controllers\CoacheController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


//Cities Routes
Route::get('/cities',[CityController::class,'index'])->name('cities.index');
Route::get('/cities/{city}/edit',[CityController::class,'edit'])->name('cities.edit');
Route::delete('/cities/{city}',[CityController::class,'destroy'])->name('cities.destroy');


//Coaches Routes
Route::get('/coaches', [CoachController::class,'index'])->name('coaches.index');

//Users Routes
Route::get('/users',[UserController::class,'index'])->name('users.index');

//Training Packages Routes
Route::get('/training-package',[TrainingPackageController::class,'index'])->name('training-package.index');
