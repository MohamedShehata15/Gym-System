<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CoachController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::post('/login/staff', [LoginController::class, 'staffLogin']);

Route::get('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth:staff'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /* ======================= Coaches Routes ========================= */
    Route::get('/coaches', [CoachController::class, 'index'])->name('coaches.index');

    Route::get('/coaches/profile/show', [CoachController::class, 'profile'])->name('coaches.profile');

    Route::get("/coaches/profile/edit", [CoachController::class, 'edit'])->name('coaches.edit');

    Route::get('/coaches/sessions', [CoachController::class, 'sessions'])->name('coaches.sessions');

    Route::get("/coaches/password", [CoachController::class, 'password'])->name('coaches.password');

    /* ===================================================================== */
});