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
//-------------------------- staff Routes --------------------------------------




//-------------------------- City Managers Routes --------------------------------

Route::get('city-managers',[cityManagerController::class,'index'])->name('city-managers.index');
Route::get('city-managers/create', [cityManagerController::class, 'create'])->name('city-managers.create');
Route::post('city-managers',[cityManagerController::class, 'store'])->name('city-managers.store');
Route::get('city-managers/{city-manager}',[cityManagerController::class, 'edit'])->name('city-managers.edit');
Route::put('city-managers/{city-manager}',[cityManagerController::class, 'update'])->name('city-managers.update');
Route::post('destroy-city-manager',[cityManagerController::class,'destroy'])->name('city-managers.destroy');
Route::get('update/{city-manager}',[cityManagerController::class,'delete'])->name('city-managers.update');

//-------------------------- Gym Managers Routes --------------------------------

// Route::get('gym-managers',[gymManagerController::class,'index'])->name('gymManager.index');
// Route::get('gym-managers/create', [gymManagerController::class, 'create'])->name('gymManager.create');
// Route::post('gym-managers',[gymManagerController::class, 'store'])->name('gymManager.store');
// Route::get('gym-managers/{gym-manager}',[gymManagerController::class, 'edit'])->name('gymManager.edit');
// Route::put('gym-managers/{gym-manager}',[gymManagerController::class, 'update'])->name('gymManager.update');
// Route::post('destroy-gym-manager',[gymManagerController::class,'destroy'])->name('gymManager.destroy');
// Route::get('update/{gym-manager}',[gymManagerController::class,'delete'])->name('gymManager.update');

//-------------------------- Coaches Routes --------------------------------
Route::get('/coaches', [CoachController::class,'index'])->name('coaches.index');

//Users Routes
Route::get('/users',[UserController::class,'index'])->name('users.index');

//Training Packages Routes
Route::get('/training-package',[TrainingPackageController::class,'index'])->name('training-package.index');
