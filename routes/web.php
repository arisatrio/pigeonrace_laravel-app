<?php

use Illuminate\Support\Facades\Route;

use App\Models\Race;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [App\Http\Controllers\HasilRaceController::class, 'index'])->name('welcome');
    Route::get('/hasil-race/{slug}', [App\Http\Controllers\HasilRaceController::class, 'show'])->name('race');
    Route::get('/hasil-race/{race_id}/basketing/{id}', [App\Http\Controllers\HasilRaceController::class, 'basketing'])->name('basketing');
    Route::get('/hasil-race/{race_id}/basketing/{id}/kelas/{kelas_id}', [App\Http\Controllers\HasilRaceController::class, 'basketingKelas'])->name('basketing-kelas');
    Route::get('/hasil-race/{race_id}/pos/{id}', [App\Http\Controllers\HasilRaceController::class, 'pos'])->name('pos');
    Route::get('/hasil-race/{race_id}/pos/{id}/kelas/{kelas_id}', [App\Http\Controllers\HasilRaceController::class, 'posKelas'])->name('pos-kelas');
    Route::get('/hasil-race/{race_id}/total-pos', [App\Http\Controllers\HasilRaceController::class, 'totalPos'])->name('total-pos');
    Route::get('/hasil-race/{race_id}/total-pos/{kelas_id}', [App\Http\Controllers\HasilRaceController::class, 'totalPosKelas'])->name('total-pos-kelas');
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
        //CLUB CRUD
        Route::resource('club', App\Http\Controllers\Admin\ClubController::class)->except(['show']);
        //WARNA BURUNG CRUD
        Route::resource('warna', App\Http\Controllers\Admin\WarnaController::class)->except(['show']);
        //HASIL RACE
        Route::get('/race-results', [App\Http\Controllers\Admin\RaceResultsController::class, 'index'])->name('race-results.index');
        Route::get('/race-results/{race_id}', [App\Http\Controllers\Admin\RaceResultsController::class, 'show'])->name('race-results.show');
        Route::get('/race-results/{race_id}/basketing/{id}', [App\Http\Controllers\Admin\RaceResultsController::class, 'basketing'])->name('basketing.index');
        Route::get('/race-results/{race_id}/basketing/{id}/kelas/{kelas_id}', [App\Http\Controllers\Admin\RaceResultsController::class, 'basketingKelas'])->name('basketing-kelas');

        Route::delete('/race-results/basketing/delete/', [App\Http\Controllers\Admin\RaceResultsController::class, 'basketingHapus'])->name('basketing-hapus');

        Route::get('/race-results/{race_id}/pos/{id}', [App\Http\Controllers\Admin\RaceResultsController::class, 'pos'])->name('pos.index');
        Route::put('/race-results/pos/{id}/validasi/{pos_id}', [App\Http\Controllers\Admin\RaceResultsController::class, 'posValidasiPost'])->name('pos.validasi-post');
        Route::get('/race-results/{race_id}/pos/{id}/kelas/{kelas_id}', [App\Http\Controllers\Admin\RaceResultsController::class, 'posKelas'])->name('pos.kelas');
        Route::get('/race-results/{race_id}/total-pos', [App\Http\Controllers\Admin\RaceResultsController::class, 'totalPos'])->name('total-pos');
        Route::get('/race-results/{race_id}/total-pos/{kelas_id}', [App\Http\Controllers\Admin\RaceResultsController::class, 'totalPosKelas'])->name('total-pos-kelas');
        Route::get('race-result/cek-map/{id}', [App\Http\Controllers\Admin\RaceResultsController::class, 'cekMap'])->name('cek-map');
        //RACE CRUD
        Route::resource('race', App\Http\Controllers\Admin\RaceController::class);
        Route::put('/race/{id}/activated', [App\Http\Controllers\Admin\RaceController::class, 'activated'])->name('race-active');
        Route::put('/race/{id}/finish', [App\Http\Controllers\Admin\RaceController::class, 'finish'])->name('race-finish');
        //DETAIL RACE
        Route::resource('race-kelas', App\Http\Controllers\Admin\RaceKelasController::class)->only(['store', 'update']);
        Route::get('/race/{race_id}/kelas/create', [App\Http\Controllers\Admin\RaceKelasController::class, 'create'])->name('race-kelas.create');
        Route::get('/race/{race_id}/kelas/{id}/edit', [App\Http\Controllers\Admin\RaceKelasController::class, 'edit'])->name('race-kelas.edit');
        Route::delete('/race/{race_id}/kelas/{id}', [App\Http\Controllers\Admin\RaceKelasController::class, 'destroy'])->name('race-kelas.destroy');
        Route::resource('race-latihan', App\Http\Controllers\Admin\RaceLatihanController::class)->only(['store', 'update']);
        Route::get('/race/{race_id}/latihan/create', [App\Http\Controllers\Admin\RaceLatihanController::class, 'create'])->name('race-latihan.create');
        Route::get('/race/{race_id}/latihan/{id}/edit', [App\Http\Controllers\Admin\RaceLatihanController::class, 'edit'])->name('race-latihan.edit');
        Route::delete('/race/{race_id}/latihan/{id}', [App\Http\Controllers\Admin\RaceLatihanController::class, 'destroy'])->name('race-latihan.destroy');
        Route::resource('race-pos', App\Http\Controllers\Admin\RacePosController::class)->except(['create', 'destroy']);
        Route::get('/race/{race_id}/pos/create', [App\Http\Controllers\Admin\RacePosController::class, 'create'])->name('race-pos.create');
        Route::get('/race/{race_id}/pos/{id}/edit', [App\Http\Controllers\Admin\RacePosController::class, 'edit'])->name('race-pos.edit');
        Route::delete('/race/{race_id}/pos/{id}', [App\Http\Controllers\Admin\RaceLatihanController::class, 'destroy'])->name('race-pos.destroy');
    });
});

// USER
Route::middleware(['auth', 'user'])->group(function () {
    Route::name('user.')->group(function (){
        Route::get('/home', [App\Http\Controllers\User\UserHomeController::class, 'home'])->name('home');
        //BURUNG CRUD
        Route::resource('burung', App\Http\Controllers\User\BurungController::class);
        //PROFILE CRUD
        Route::resource('profile', App\Http\Controllers\User\ProfileController::class)->only(['edit', 'update']);
        Route::get('/profile/{id}/akun', [App\Http\Controllers\User\ProfileController::class, 'editProfile'])->name('edit-profile');
        Route::put('/profile/{id}/update', [App\Http\Controllers\User\ProfileController::class, 'profileStore'])->name('edit-profile-store');
        Route::put('/profile/{id}/update-password', [App\Http\Controllers\User\ProfileController::class, 'updatePassword'])->name('update-password-store');
        //RACE
        Route::resource('race', App\Http\Controllers\User\RaceController::class)->except(['show', 'edit', 'update', 'destroy']);
        Route::get('race/{slug}', [App\Http\Controllers\User\RaceController::class, 'show'])->name('race.show');
        Route::get('/riwayat', [App\Http\Controllers\User\RaceController::class, 'indexRiwayat'])->name('riwayat-index');
        Route::get('/riwayat/{id}', [App\Http\Controllers\User\RaceController::class, 'riwayatPos'])->name('riwayat-pos');
        Route::get('/riwayat/basketing/{id}', [App\Http\Controllers\User\RaceController::class, 'basketingPos'])->name('basketing-pos');
        Route::get('/riwayat/basketing/{id}/kelas/{kelas_id}', [App\Http\Controllers\User\RaceController::class, 'basketingKelas'])->name('basketing-kelas');
        Route::get('/riwayat/pos/{id}/rank', [App\Http\Controllers\User\RaceController::class, 'posRank'])->name('pos-rank');
        Route::get('/riwayat/pos/{id}/rank/{kelas_id}', [App\Http\Controllers\User\RaceController::class, 'posKelasRank'])->name('pos-kelas-rank');
        Route::get('/riwayat/total-pos/{race_id}/', [App\Http\Controllers\User\RaceController::class, 'totalPos'])->name('total-pos');
        Route::get('/race-results/{race_id}/total-pos/{kelas_id}', [App\Http\Controllers\User\RaceController::class, 'totalPosKelas'])->name('total-pos-kelas');
        Route::get('/riwayat/total-pos/{race_id}/{burung_id}', [App\Http\Controllers\User\RaceController::class, 'totalPosDetail'])->name('total-pos-detail');
        //RACE MODE
        Route::post('/race/{id}/join', [App\Http\Controllers\User\UserHomeController::class, 'joinRace'])->name('join-race');
        Route::get('/home/race/{id}', [App\Http\Controllers\User\UserHomeController::class, 'raceMode'])->name('race-mode');
        Route::get('/home/race/pos/{id}', [App\Http\Controllers\User\UserHomeController::class, 'posMode'])->name('pos-mode');
        Route::post('/race/{id}/', [App\Http\Controllers\User\UserHomeController::class, 'stopJoin'])->name('stop-join');
        Route::post('/race/basketing/{race_pos_id}/', [App\Http\Controllers\User\UserHomeController::class, 'basketingStore'])->name('store-basketing');
        Route::delete('/race/basketing/{race_pos_id}/{burung_id}', [App\Http\Controllers\User\UserHomeController::class, 'basketingHapus'])->name('hapus-basketing');
        Route::post('/race/clock/{race_pos_id}/', [App\Http\Controllers\User\UserHomeController::class, 'clockStore'])->name('store-clock');
    });
});