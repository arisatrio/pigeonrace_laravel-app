<?php

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

Auth::routes();

// SUPER ADMIN
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::prefix('super-admin')->name('superadmin.')->group(function (){
        Route::get('/dashboard', [App\Http\Controllers\SADashboardController::class, 'index'])->name('dashboard');
        //USER CRUD
        Route::resource('user', App\Http\Controllers\UserController::class);
    });
});

// ADMIN / PANITIA
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function (){
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'admin'])->name('dashboard');
        Route::resource('club', App\Http\Controllers\Admin\ClubController::class);
        //
        Route::resource('race', App\Http\Controllers\Admin\RaceController::class);
    });
});

// USER
Route::middleware(['auth'])->group(function () {
    Route::name('user.')->group(function (){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'user'])->name('home');
        Route::resource('burung', App\Http\Controllers\User\BurungController::class);
        Route::resource('profile', App\Http\Controllers\User\ProfileController::class)->only(['edit', 'update']);
        //
        Route::resource('race', App\Http\Controllers\User\RaceController::class);
    });
});