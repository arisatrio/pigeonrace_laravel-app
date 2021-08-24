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

//CEK
Route::get('/cek-distance', function () {
    return view('cek-distance');
});
Route::post('/distance', [App\Http\Controllers\UserController::class, 'distance'])->name('distance');

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
        Route::resource('race-kelas', App\Http\Controllers\Admin\RaceKelasController::class)->except(['create', 'destroy']);
        Route::get('/race/{race_id}/kelas/create', [App\Http\Controllers\Admin\RaceKelasController::class, 'create'])->name('race-kelas.create');
        Route::delete('/race/{race_id}/kelas/{id}', [App\Http\Controllers\Admin\RaceKelasController::class, 'destroy'])->name('race-kelas.destroy');
        // route edit dan update kelas
        Route::resource('race-latihan', App\Http\Controllers\Admin\RaceLatihanController::class)->except(['create', 'destroy']);
        Route::get('/race/{race_id}/latihan/create', [App\Http\Controllers\Admin\RaceLatihanController::class, 'create'])->name('race-latihan.create');
        Route::delete('/race/{race_id}/latihan/{id}', [App\Http\Controllers\Admin\RaceLatihanController::class, 'destroy'])->name('race-latihan.destroy');
        // route edit dan update latihan
        Route::resource('race-pos', App\Http\Controllers\Admin\RacePosController::class)->except(['create', 'destroy']);
        Route::get('/race/{race_id}/pos/create', [App\Http\Controllers\Admin\RacePosController::class, 'create'])->name('race-pos.create');
        Route::get('/race/{race_id}/pos/{id}/edit', [App\Http\Controllers\Admin\RacePosController::class, 'edit'])->name('race-pos.edit');
        Route::delete('/race/{race_id}/pos/{id}', [App\Http\Controllers\Admin\RaceLatihanController::class, 'destroy'])->name('race-pos.destroy');
    });
});

// USER
Route::middleware(['auth'])->group(function () {
    Route::name('user.')->group(function (){
        Route::get('/home', [App\Http\Controllers\User\UserHomeController::class, 'index'])->name('home');
        Route::resource('burung', App\Http\Controllers\User\BurungController::class);
        Route::resource('profile', App\Http\Controllers\User\ProfileController::class)->only(['edit', 'update']);
        //
        Route::resource('race', App\Http\Controllers\User\RaceController::class);
        //
        Route::post('/race/{id}/join', [App\Http\Controllers\User\RaceController::class, 'joinRace'])->name('join-race');
        Route::post('/race/{id}/', [App\Http\Controllers\User\UserHomeController::class, 'stopJoin'])->name('stop-join');
        Route::get('/race/{id}/basketing/{race_pos_id}', [App\Http\Controllers\User\UserHomeController::class, 'basketing'])->name('add-basketing');
        Route::post('/race/basketing/{race_pos_id}/', [App\Http\Controllers\User\UserHomeController::class, 'basketingStore'])->name('store-basketing');
        Route::post('/race/clock/{race_pos_id}/', [App\Http\Controllers\User\UserHomeController::class, 'clockStore'])->name('store-clock');
    });
});