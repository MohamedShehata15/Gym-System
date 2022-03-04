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
use App\Http\Controllers\StaffController;
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
Route::get('staff',[StaffController::class,'index'])->name('staff.index');
Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::post('staff',[StaffController::class, 'store'])->name('staff.store');
Route::get('staff/{staff}',[StaffController::class, 'edit'])->name('staff.edit');
Route::put('staff/{staff}',[StaffController::class, 'update'])->name('staff.update');
Route::post('destroy-staff',[StaffController::class,'destroy'])->name('staff.destroy');
Route::get('update/{staff}',[StaffController::class,'delete'])->name('cities.delete');
//-------------------------- Coaches Routes --------------------------------
Route::get('/coaches', [CoachController::class,'index'])->name('coaches.index');

//Users Routes
Route::get('/users',[UserController::class,'index'])->name('users.index');

//Training Packages Routes
Route::get('/training-package',[TrainingPackageController::class,'index'])->name('training-package.index');
