<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TahapanProyekController;

//dasboard//
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//proyek//
Route::get('/proyek/{id}/lihat', [ProyekController::class, 'show'])->name('proyek.show');
Route::resource('/proyek', ProyekController::class);
//user
Route::get('/user/{id}/lihat', [UserController::class, 'show'])->name('user.show');
Route::resource('/user', UserController::class);
//Warga
Route::get('/warga/{id}/lihat', [WargaController::class, 'show'])->name('warga.show');
Route::resource('warga', WargaController::class);
//Tahapan Proyek
Route::get('/tahapan/{id}/lihat', [TahapanProyekController::class, 'show'])->name('tahapan.show');
Route::resource('tahapan', TahapanProyekController::class);

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
