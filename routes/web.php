<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TahapanProyekController;

/*
|| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK USER LOGIN
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['checkislogin']], function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');

    /*
    |----------------------------------------------------------------------
    | ADMIN - full CRUD
    |----------------------------------------------------------------------
    */
    Route::group(['middleware' => ['checkrole:admin']], function () {
        Route::get('/proyek/{id}/lihat', [ProyekController::class, 'show'])->name('proyek.show');
        Route::resource('/proyek', ProyekController::class)->except(['show']);

        Route::get('/user/{id}/lihat', [UserController::class, 'show'])->name('user.show');
        Route::resource('/user', UserController::class)->except(['show']);

        Route::get('/tahapan/{id}/lihat', [TahapanProyekController::class, 'show'])->name('tahapan.show');
        Route::resource('/tahapan', TahapanProyekController::class)->except(['show']);

        Route::get('/warga/{id}/lihat', [WargaController::class, 'show'])->name('warga.show');
        Route::resource('/warga', WargaController::class)->except(['show']);
    });

    /*
    |----------------------------------------------------------------------
    | STAFF & USER - read-only (lihat saja)
    |----------------------------------------------------------------------
    */
    Route::group(['middleware' => ['checkrole:staff,user']], function () {
        Route::get('/proyek', [ProyekController::class, 'index'])->name('proyek.index');
        Route::get('/proyek/{id}/lihat', [ProyekController::class, 'show'])->name('proyek.show');

        Route::get('/tahapan', [TahapanProyekController::class, 'index'])->name('tahapan.index');
        Route::get('/tahapan/{id}/lihat', [TahapanProyekController::class, 'show'])->name('tahapan.show');

        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/warga/{id}/lihat', [WargaController::class, 'show'])->name('warga.show');
    });
});
