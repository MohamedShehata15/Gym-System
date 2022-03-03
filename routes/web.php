<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

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

Route::get('/coaches', function () {
    return view('coaches.index');
});


Route::get('/sessions',[SessionController::class, 'index'])->name('sessions.index');
Route::get('/sessions/create',[SessionController::class, 'create'])->name('sessions.create');
Route::post('/sessions',[SessionController::class, 'store'])->name('sessions.store');
Route::post('destroy', [SessionController::class, 'destroy'])->name('sessions.destroy'); 
Route::get('edit', [SessionController::class, 'edit'])->name('sessions.edit');
Route::put('/sessions', [SessionController::class, 'update'])->name('sessions.update');

