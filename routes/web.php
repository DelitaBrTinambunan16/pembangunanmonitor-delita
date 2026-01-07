<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\KontraktorController;
use App\Http\Controllers\LokasiProyekController;
use App\Http\Controllers\ProgresProyekController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\TahapanProyekController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| ROOT → WAJIB LOGIN → DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (! auth()->check()) {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER PHOTO
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| LOGIN REQUIRED
|--------------------------------------------------------------------------
*/
Route::middleware(['checklogin'])->group(function () {

    Route::delete('/media/{id}', [MediaController::class, 'destroy'])
        ->name('media.destroy');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD (SATU UNTUK SEMUA ROLE)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('proyek', ProyekController::class);
        Route::resource('tahapan', TahapanProyekController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('progres_proyek', ProgresProyekController::class);
        Route::resource('lokasi', LokasiProyekController::class);
        Route::resource('kontraktor', KontraktorController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | STAFF
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:staff'])
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {

            Route::resource('proyek', ProyekController::class)->only(['index', 'create', 'store', 'show']);
            Route::resource('tahapan', TahapanProyekController::class)->only(['index', 'create', 'store', 'show']);
            Route::resource('kontraktor', KontraktorController::class)->only(['index', 'create', 'store', 'show']);
            Route::resource('lokasi', LokasiProyekController::class)->only(['index', 'create', 'store', 'show']);
            Route::resource('progres_proyek', ProgresProyekController::class)->only(['index', 'create', 'store', 'show']);
            Route::resource('warga', WargaController::class)->only(['index', 'create', 'store', 'show']);
        });

    /*
    |--------------------------------------------------------------------------
    | USER (VIEW ONLY)
    |--------------------------------------------------------------------------
    */
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

/*
|--------------------------------------------------------------------------
| IDENTITAS (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/identitas', [IdentitasController::class, 'index'])->name('identitas');
