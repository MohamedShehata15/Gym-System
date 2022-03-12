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
use App\Http\Controllers\CityManagerController;
use App\Http\Controllers\GymManagerController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RevenueController;

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


Auth::routes(['register' => false]);

Route::get('logout', [LoginController::class, 'logout']);


Route::group(['middleware' => 'auth', 'middleware' => 'forbid-banned-user', 'middleware' => 'logs-out-banned-user'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /* ======================= Admin Routes ========================= */
    Route::group(['middleware' => ['role_or_permission:Super-Admin']], function () {

        Route::post('edit-city', [CityController::class, 'edit'])->name('cities.edit');
        Route::post('destroy-city', [CityController::class, 'destroy'])->name('cities.destroy');
        Route::post('store-city', [CityController::class, 'store'])->name('cities.store');

        //-------------------------- City Managers Routes --------------------------------
        Route::get('city-managers/create', [CityManagerController::class, 'create'])->name('city-managers.create');
        // Route::post('city-managers', [cityManagerController::class, 'store'])->name('city-managers.store');
        // Route::get('city-managers/{cityManagerId}/edit', [cityManagerController::class, 'edit'])->name('city-managers.edit');
        // Route::put('city-managers/{cityManagerId}', [cityManagerController::class, 'update'])->name('city-managers.update');
        Route::post('destroy-city-manager', [cityManagerController::class, 'destroy'])->name('city-managers.destroy');


        // --------------------------------------------
        Route::GET('/city-managers', [CityManagerController::class, 'index'])->name('city-managers.index');
        // Route::GET('/city-managers/create', [CityManagerController::class, 'create'])->name('city-managers.create');
        Route::GET('/city-managers/{id}', [CityManagerController::class, 'show'])->name('city-managers.show');
        Route::GET('/city-managers/{id}/edit', [CityManagerController::class, 'edit'])->name('city-managers.edit');

        Route::PUT('/city-managers/{id}', [CityManagerController::class, 'update'])->name('city-managers.update');
        Route::POST('/city-managers', [CityManagerController::class, 'store'])->name('city-managers.store');
        Route::GET('/city-managers/{id}/ban', [CityManagerController::class, 'ban'])->name('city-managers.ban');


        //------------------------- Cities Routes ------------------------------
        Route::get('cities', [CityController::class, 'index'])->name('cities.index');
        Route::get('/cities/{id}/gyms', [CityController::class, 'gyms']);
        Route::get('city-managers', [CityManagerController::class, 'index'])->name('city-managers.index');



        //-------------------------- Users Routes --------------------------------
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('destroy-user', [UserController::class, 'destroy'])->name('users.destroy');
    });


    Route::group(['middleware' => ['role_or_permission:city_manager||Super-Admin']], function () {
        /* ======================= City Manager Routes ========================= */

        // Route::group(['auth', 'isBanned'], function () {

        Route::GET('/gyms', [GymController::class, 'index'])->name('gyms.index');
        Route::POST('/gyms', [GymController::class, 'store'])->name('gyms.store');
        Route::GET('/gyms/create', [GymController::class, 'create'])->name('gyms.create');
        Route::GET('/gyms/{id}/edit', [GymController::class, 'edit'])->name('gyms.edit');
        Route::GET('/gyms/{id}', [GymController::class, 'show'])->name('gyms.show');

        Route::get('/gyms/{id}/users', [GymController::class, 'users']);

        Route::get('/gyms/{id}/coaches', [GymController::class, 'coaches']);

        Route::PUT('/gyms/{id}', [GymController::class, 'update'])->name('gyms.update');
        Route::post('destroy-gym', [GymController::class, 'destroy'])->name('gyms.destroy');


        /* ===================================================================== */


        //-------------------------- Gym Managers Routes --------------------------------

        Route::get('gym-managers', [GymManagerController::class, 'index'])->name('gym-managers.index');
        Route::get('gym-managers/create', [GymManagerController::class, 'create'])->name('gym-managers.create');
        Route::post('gym-managers', [GymManagerController::class, 'store'])->name('gym-managers.store');
        Route::get('gym-managers/{gymManagerId}/edit', [GymManagerController::class, 'edit'])->name('gym-managers.edit');

        Route::put('gym-managers/{gymManagerId}', [GymManagerController::class, 'update'])->name('gym-managers.update');
        Route::post('destroy-gym-manager', [GymManagerController::class, 'destroy'])->name('gym-managers.destroy');
        Route::post('ban-gym-manager', [GymManagerController::class, 'ban'])->name('gym-managers.ban');
        Route::get('getGym/{id}', function ($id) {
            $gym = App\Models\Gym::where('city_id', $id)->get();
            return response()->json($gym);
        });
    });

    /* ===================================================================== */
    Route::get('/gyms/{id}/packages', [GymController::class, 'packages']);

    Route::group(['middleware' => ['role_or_permission:coach|Super-Admin']], function () {
        /* ======================= Coaches Routes ========================= */
        Route::get("/coaches/{id}/profile/edit", [CoachController::class, 'edit'])->name('coaches.edit');
        Route::put('coaches/{coachId}', [coachController::class, 'update'])->name('coaches.update');
    });



    Route::group(['middleware' => ['role_or_permission:Super-Admin|city_manager|gym_manager']], function () {
        /* ======================= Payment Routes ========================= */
        Route::get('stripe', [StripePaymentController::class, 'stripe']);
        Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

        //-------------------------- Purchases Routes --------------------------------
        Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
        Route::post('destroy-purchase', [PurchaseController::class, 'destroy'])->name('destroy-purchase');

        /* ======================= Attendance Routes ========================= */
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendances.index');
        /* ======================= Revenue Routes ========================= */
        Route::get('revenue', [RevenueController::class, 'show'])->name('revenue.show');



        //-------------------------- Training Packages Routes --------------------------------
        Route::get('training-packages', [TrainingPackageController::class, 'index'])->name('training-packages.index');
        Route::get('training-packages/create', [TrainingPackageController::class, 'create'])->name('training-packages.create');
        Route::post('training-packages', [TrainingPackageController::class, 'store'])->name('training-packages.store');
        Route::get('training-packages/{trainingpackage}/edit', [TrainingPackageController::class, 'edit'])->name('training-packages.edit');
        Route::put('training-packages/{trainingpackage}', [TrainingPackageController::class, 'update'])->name('training-packages.update');
        Route::post('destroy-package', [TrainingPackageController::class, 'destroy'])->name('training-packages.destroy');
    });


    /* ======================== Coaches ============================================= */
    Route::get('coaches', [coachController::class, 'index'])->name('coaches.index');
    Route::post('coaches', [coachController::class, 'store'])->name('coaches.store');
    Route::get('coaches/create', [coachController::class, 'create'])->name('coaches.create');
    // Route::get('coaches/{coachId}/edit', [coachController::class, 'edit'])->name('coaches.edit');
    Route::post('destroy-coach', [coachController::class, 'destroy'])->name('coaches.destroy');
    Route::get('getGym/{id}', function ($id) {
        $gym = App\Models\Gym::where('city_id', $id)->get();
        return response()->json($gym);
    });

    Route::get('/coaches/{id}/sessions', [CoachController::class, 'sessions'])->name('coaches.sessions');
    Route::get('/coaches/{id}', [CoachController::class, 'show'])->name('coaches.show');
    Route::get('/coaches/{id}/profile', [CoachController::class, 'profile'])->name('coaches.profile');
    Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
    /* ===================================================================== */


    Route::get("/coaches/{id}/password", [CoachController::class, 'password'])->name('coaches.password');
    Route::PUT("coach-password/{id}", [CoachController::class, 'passwordUpdate'])->name('coaches.passwordUpdate');
    /* ===================================================================== */


    /* ======================= Sessions Routes ========================= */
    Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');
    Route::post('destroy-session', [SessionController::class, 'destroy'])->name('sessions.destroy');
    Route::get('/sessions/edit', [SessionController::class, 'edit'])->name('sessions.edit');
    Route::put('/sessions', [SessionController::class, 'update'])->name('sessions.update');
    /* ===================================================================== */
});