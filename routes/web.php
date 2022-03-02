<?php


use App\Http\Controllers\GymController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::GET('/', function () {
    return view('welcome');
});

Route::GET('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::GET('/coaches', function () {
    return view('coaches.index');
});

Route::GET('/gyms',[GymController::class ,'index'])->name('gyms.index');
Route::GET('/gyms/create',[GymController::class ,'create'])->name('gyms.create');
Route::POST('/gyms',[GymController::class ,'store'])->name('gyms.store');
Route::GET('/gyms/{id}',[GymController::class ,'show'])->name('gyms.show');
Route::GET('/gyms/{id}/edit',[GymController::class ,'edit'])->name('gyms.edit');
Route::PUT('/gyms/{id}',[GymController::class ,'update'])->name('gyms.update');
Route::DELETE('/gyms/{id}',[GymController::class ,'destroy'])->name('gyms.destroy');