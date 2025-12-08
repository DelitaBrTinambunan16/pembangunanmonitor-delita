<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TahapanProyekController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ROUTE FOTO USER (PROFILE / MEDIA / DEFAULT)
|--------------------------------------------------------------------------
*/
Route::get('/user/photo/{id}', function ($id) {

    $user = \App\Models\User::with('media')->findOrFail($id);

    // Cek profile_picture
    if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
        return response()->file(storage_path('app/public/' . $user->profile_picture));
    }

    // Cek relasi media
    if ($user->media && Storage::disk('public')->exists($user->media->file_url)) {
        return response()->file(storage_path('app/public/' . $user->media->file_url));
    }

    // Default avatar
    return response()->file(public_path('assets/default-avatar.png'));

})->name('user.photo');


/*
|--------------------------------------------------------------------------
| ROUTES UNTUK USER LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware(['checkislogin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');

    /*
    |--------------------------------------------------------------------------
    | ADMIN - Full CRUD
    |--------------------------------------------------------------------------
    */
    Route::middleware(['checkrole:admin'])->group(function () {

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
    |--------------------------------------------------------------------------
    | STAFF + USER (READ ONLY)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['checkrole:staff,user'])->group(function () {

        Route::get('/proyek', [ProyekController::class, 'index'])->name('proyek.index');
        Route::get('/proyek/{id}/lihat', [ProyekController::class, 'show'])->name('proyek.show');

        Route::get('/tahapan', [TahapanProyekController::class, 'index'])->name('tahapan.index');
        Route::get('/tahapan/{id}/lihat', [TahapanProyekController::class, 'show'])->name('tahapan.show');

        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/warga/{id}/lihat', [WargaController::class, 'show'])->name('warga.show');
    });

    /*
    |--------------------------------------------------------------------------
    | PROFILE USER (harus login)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//unk media user 
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
