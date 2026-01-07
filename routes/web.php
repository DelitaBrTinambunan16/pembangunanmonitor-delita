<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\KontraktorController;
use App\Http\Controllers\LokasiProyekController;
use App\Http\Controllers\ProgresProyekController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\TahapanProyekController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;use Illuminate\Support\Facades\Route;use Illuminate\Support\Facades\Storage;

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PROFILE PHOTO

Route::get('/user/photo/{id}', function ($id) {
    $user = \App\Models\User::with('media')->findOrFail($id);
    if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
        return response()->file(storage_path('app/public/' . $user->profile_picture));
    }
    if ($user->media && Storage::disk('public')->exists($user->media->file_url)) {
        return response()->file(storage_path('app/public/' . $user->media->file_url));
    }
    return response()->file(public_path('assets/default-avatar.png'));
})->name('user.photo');

// login required routes
Route::middleware(['checklogin'])->group(function () {

    // Dashboard

    Route::middleware(['role:admin'])->group(function () {
// Admin
        Route::resource('user', UserController::class);
        Route::resource('proyek', ProyekController::class);
        Route::resource('tahapan', TahapanProyekController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('progres_proyek', ProgresProyekController::class);
        Route::resource('lokasi', LokasiProyekController::class);
        Route::resource('kontraktor', KontraktorController::class);
    });
// Staff
    Route::middleware(['role:staff'])
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {
            // PROYEK
            Route::resource('proyek', ProyekController::class)->only(['index', 'create', 'store', 'show']);
            // TAHAPAN
            Route::resource('tahapan', TahapanProyekController::class)->only(['index', 'create', 'store', 'show']);
            // KONTRAKTOR
            Route::resource('kontraktor', KontraktorController::class)->only(['index', 'create', 'store', 'show']);
            // LOKASI
            Route::resource('lokasi', LokasiProyekController::class)->only(['index', 'create', 'store', 'show']);
            // PROGRES
            Route::resource('progres_proyek', ProgresProyekController::class)->only(['index', 'create', 'store', 'show']);
            // WARGA
            Route::resource('warga', WargaController::class)->only(['index', 'create', 'store', 'show']);
        });
// User
    Route::middleware(['role:user'])
        ->prefix('view')
        ->name('view.')
        ->group(function () {

            Route::resource('proyek', ProyekController::class)->only(['index', 'show']);
            Route::resource('tahapan', TahapanProyekController::class)->only(['index', 'show']);
            Route::resource('kontraktor', KontraktorController::class)->only(['index', 'show']);
            Route::resource('lokasi', LokasiProyekController::class)->only(['index', 'show']);
            Route::resource('progres_proyek', ProgresProyekController::class)->only(['index', 'show']);
            Route::resource('warga', WargaController::class)->only(['index', 'show']);
        });
});
// Identitas
Route::get('/identitas', [IdentitasController::class, 'index'])->name('identitas');
