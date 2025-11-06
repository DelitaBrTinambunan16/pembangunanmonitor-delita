<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\DashboardController;


//dasboard//
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//proyek//
Route::resource('/proyek', ProyekController::class);
//user
Route::resource('/user', UserController::class);
//Warga
Route::resource('warga', WargaController::class);
use App\Http\Controllers\AuthController;

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
