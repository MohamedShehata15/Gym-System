<?php

use App\Http\Controllers\CityManagerController;
use App\Http\Controllers\GymController;
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

Route::GET('/', function () {
    return view('welcome');
});

Route::GET('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();



Route::post('/login/staff', [LoginController::class, 'staffLogin']);

Route::get('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth:staff'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    /* ======================= City Manager Routes ========================= */

    Route::group(['auth', 'isBanned'], function () {

        Route::GET('/coaches', function () {
            return view('coaches.index');
        });
        Route::GET('/gyms', [GymController::class, 'index'])->name('gyms.index');
        Route::GET('/gyms/create', [GymController::class, 'create'])->name('gyms.create');
        Route::POST('/gyms', [GymController::class, 'store'])->name('gyms.store');
        Route::GET('/gyms/{id}', [GymController::class, 'show'])->name('gyms.show');
        Route::GET('/gyms/{id}/edit', [GymController::class, 'edit'])->name('gyms.edit');
        Route::PUT('/gyms/{id}', [GymController::class, 'update'])->name('gyms.update');
        Route::DELETE('/gyms/{id}', [GymController::class, 'destroy'])->name('gyms.destroy');

        Route::GET('/cityManagers', [CityManagerController::class, 'index'])->name('cityManagers.index');
        Route::GET('/cityManagers/create', [CityManagerController::class, 'create'])->name('cityManagers.create');
        Route::POST('/cityManagers', [CityManagerController::class, 'store'])->name('cityManagers.store');
        Route::GET('/cityManagers/{id}', [CityManagerController::class, 'show'])->name('cityManagers.show');
        Route::GET('/cityManagers/{id}/edit', [CityManagerController::class, 'edit'])->name('cityManagers.edit');
        Route::PUT('/cityManagers/{id}', [CityManagerController::class, 'update'])->name('cityManagers.update');
        Route::DELETE('/cityManagers/{id}', [CityManagerController::class, 'destroy'])->name('cityManagers.destroy');
        Route::GET('/cityManagers/{id}/ban', [CityManagerController::class, 'ban'])->name('cityManagers.ban');
    });


    /* ===================================================================== */


    /* ======================= Coaches Routes ========================= */
    Route::get('/coaches', [CoachController::class, 'index'])->name('coaches.index');

    Route::get('/coaches/profile/show', [CoachController::class, 'profile'])->name('coaches.profile');

    Route::get("/coaches/profile/edit", [CoachController::class, 'edit'])->name('coaches.edit');

    Route::get('/coaches/sessions', [CoachController::class, 'sessions'])->name('coaches.sessions');

    Route::get("/coaches/password", [CoachController::class, 'password'])->name('coaches.password');

    /* ===================================================================== */
});