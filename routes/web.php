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
use App\Http\Controllers\CoachController;
use App\Http\Controllers\cityManagerController;
use App\Http\Controllers\gymManagerController;
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


//------------------------- Cities Routes ------------------------------
Route::get('cities',[CityController::class,'index'])->name('cities.index');
//Route::get('update/{city}',[CityController::class,'update'])->name('cities.update');
Route::post('edit-city',[CityController::class,'edit'])->name('cities.edit');
Route::post('destroy-city',[CityController::class,'destroy'])->name('cities.destroy');
Route::post('store-city',[CityController::class,'store'])->name('cities.store');

//-------------------------- City Managers Routes --------------------------------

Route::get('city-managers',[cityManagerController::class,'index'])->name('city-managers.index');
Route::get('city-managers/create', [cityManagerController::class, 'create'])->name('city-managers.create');
Route::post('city-managers',[cityManagerController::class, 'store'])->name('city-managers.store');
Route::get('city-managers/{cityManagerId}/edit',[cityManagerController::class, 'edit'])->name('city-managers.edit');
Route::put('city-managers/{cityManagerId}',[cityManagerController::class, 'update'])->name('city-managers.update');
Route::post('destroy-city-manager',[cityManagerController::class,'destroy'])->name('city-managers.destroy');

//-------------------------- Gym Managers Routes --------------------------------

Route::get('gym-managers',[gymManagerController::class,'index'])->name('gym-managers.index');
Route::get('gym-managers/create', [gymManagerController::class, 'create'])->name('gym-managers.create');
Route::post('gym-managers',[gymManagerController::class, 'store'])->name('gym-managers.store');
Route::get('gym-managers/{gymManagerId}/edit',[gymManagerController::class, 'edit'])->name('gym-managers.edit');
Route::put('gym-managers/{gymManagerId}',[gymManagerController::class, 'update'])->name('gym-managers.update');
Route::post('destroy-gym-manager',[gymManagerController::class,'destroy'])->name('gym-managers.destroy');
Route::get('getGym/{id}', function ($id) {
    $gym = App\Models\Gym::where('city_id',$id)->get();
    return response()->json($gym);
});
//-------------------------- Coaches Routes --------------------------------
Route::get('/coaches', [CoachController::class,'index'])->name('coaches.index');

//Users Routes
Route::get('/users',[UserController::class,'index'])->name('users.index');

//---------------------------- Training Packages Routes -----------------------------------------------
Route::get('training-packages',[TrainingPackageController::class,'index'])->name('training-packages.index');
Route::get('training-packages/create', [TrainingPackageController::class, 'create'])->name('training-packages.create');
Route::post('training-packages',[TrainingPackageController::class, 'store'])->name('training-packages.store');
Route::get('training-packages/{trainingpackage}/edit',[TrainingPackageController::class,'edit'])->name('training-packages.edit');
Route::put('training-packages/{trainingpackage}',[TrainingPackageController::class, 'update'])->name('training-packages.update');
Route::post('destroy-package',[TrainingPackageController::class,'destroy'])->name('training-packages.destroy');
