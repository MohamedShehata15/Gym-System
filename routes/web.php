<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CoachController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TrainingPackageController;
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

Route::GET('/', function () {
    return view('welcome');
});

// Route::GET('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();




Route::post('/login/staff', [LoginController::class, 'staffLogin']);

Route::get('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    /* ======================= Admin Routes ========================= */

    //------------------------- Cities Routes ------------------------------
    Route::get('cities', [CityController::class, 'index'])->name('cities.index');
    //Route::get('update/{city}',[CityController::class,'update'])->name('cities.update');
    Route::post('edit-city', [CityController::class, 'edit'])->name('cities.edit');
    Route::post('destroy-city', [CityController::class, 'destroy'])->name('cities.destroy');
    Route::post('store-city', [CityController::class, 'store'])->name('cities.store');

    //-------------------------- City Managers Routes --------------------------------

    Route::get('city-managers', [cityManagerController::class, 'index'])->name('city-managers.index');
    Route::get('city-managers/create', [cityManagerController::class, 'create'])->name('city-managers.create');
    Route::post('city-managers', [cityManagerController::class, 'store'])->name('city-managers.store');
    Route::get('city-managers/{cityManagerId}/edit', [cityManagerController::class, 'edit'])->name('city-managers.edit');
    Route::put('city-managers/{cityManagerId}', [cityManagerController::class, 'update'])->name('city-managers.update');
    Route::post('destroy-city-manager', [cityManagerController::class, 'destroy'])->name('city-managers.destroy');

    //-------------------------- Gym Managers Routes --------------------------------

    Route::get('gym-managers', [gymManagerController::class, 'index'])->name('gym-managers.index');
    Route::get('gym-managers/create', [gymManagerController::class, 'create'])->name('gym-managers.create');
    Route::post('gym-managers', [gymManagerController::class, 'store'])->name('gym-managers.store');
    Route::get('gym-managers/{gymManagerId}/edit', [gymManagerController::class, 'edit'])->name('gym-managers.edit');
    Route::put('gym-managers/{gymManagerId}', [gymManagerController::class, 'update'])->name('gym-managers.update');
    Route::post('destroy-gym-manager', [gymManagerController::class, 'destroy'])->name('gym-managers.destroy');
    Route::get('getGym/{id}', function ($id) {
        $gym = App\Models\Gym::where('city_id', $id)->get();
        return response()->json($gym);
    });

    //-------------------------- Training Packages Routes --------------------------------
    Route::get('training-packages', [TrainingPackageController::class, 'index'])->name('training-packages.index');
    Route::get('training-packages/create', [TrainingPackageController::class, 'create'])->name('training-packages.create');
    Route::post('training-packages', [TrainingPackageController::class, 'store'])->name('training-packages.store');
    Route::get('training-packages/{trainingpackage}/edit', [TrainingPackageController::class, 'edit'])->name('training-packages.edit');
    Route::put('training-packages/{trainingpackage}', [TrainingPackageController::class, 'update'])->name('training-packages.update');
    Route::post('destroy-package', [TrainingPackageController::class, 'destroy'])->name('training-packages.destroy');




    //-------------------------- Coaches Routes --------------------------------
    Route::get('coaches', [coachController::class, 'index'])->name('coaches.index');
    Route::get('coaches/create', [coachController::class, 'create'])->name('coaches.create');
    Route::post('coaches', [coachController::class, 'store'])->name('coaches.store');
    Route::get('coaches/{coachId}/edit', [coachController::class, 'edit'])->name('coaches.edit');
    Route::put('coaches/{coachId}', [coachController::class, 'update'])->name('coaches.update');
    Route::post('destroy-coach', [coachController::class, 'destroy'])->name('coaches.destroy');
    Route::get('getGym/{id}', function ($id) {
        $gym = App\Models\Gym::where('city_id', $id)->get();
        return response()->json($gym);
    });




    //-------------------------- Users Routes --------------------------------

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('destroy-user', [UserController::class, 'destroy'])->name('users.destroy');



    /* ======================= Gym Manager Routes ========================= */
    Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');
    Route::post('destroy', [SessionController::class, 'destroy'])->name('sessions.destroy');
    Route::get('edit', [SessionController::class, 'edit'])->name('sessions.edit');
    Route::put('/sessions', [SessionController::class, 'update'])->name('sessions.update');
    /* ===================================================================== */

    /* ===================================================================== */

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

  
   /* ======================= Attendance Routes ========================= */
   Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
});