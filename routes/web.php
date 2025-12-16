<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\KontraktorController;
use App\Http\Controllers\LokasiProyekController;
use App\Http\Controllers\ProgresProyekController;
use App\Http\Controllers\TahapanProyekController;

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN / LOGOUT)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PROFILE PHOTO
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
| LOGIN REQUIRED (ALL ROLES)
|--------------------------------------------------------------------------
*/

Route::middleware(['checklogin'])->group(function () {

    // Dashboard untuk semua role
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



    /*
    |--------------------------------------------------------------------------
    | ADMIN (FULL CRUD)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {

        Route::resource('proyek', ProyekController::class);
        Route::resource('user', UserController::class);
        Route::resource('tahapan', TahapanProyekController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('progres_proyek', ProgresProyekController::class);
        Route::resource('lokasi', LokasiProyekController::class);
        Route::resource('kontraktor', KontraktorController::class);

        // Upload file khusus admin
        Route::post('/proyek/{id}/upload-files', [ProyekController::class, 'uploadFiles'])
            ->name('proyek.uploadFiles');
    });



    /*
    |--------------------------------------------------------------------------
    | STAFF + USER (READ ONLY)
    |--------------------------------------------------------------------------
    | Untuk menghindari bentrok dengan route-admin (resource route),
    | route staff/user diberikan PREFIX khusus: /view/
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:staff,user'])
        ->prefix('view')
        ->name('view.')
        ->group(function () {

            // PROYEK
            Route::get('proyek', [ProyekController::class, 'index'])->name('proyek.index');
            Route::get('proyek/{id}', [ProyekController::class, 'show'])->name('proyek.show');

            // TAHAPAN
            Route::get('tahapan', [TahapanProyekController::class, 'index'])->name('tahapan.index');
            Route::get('tahapan/{id}', [TahapanProyekController::class, 'show'])->name('tahapan.show');

            // WARGA
            Route::get('warga', [WargaController::class, 'index'])->name('warga.index');
            Route::get('warga/{id}', [WargaController::class, 'show'])->name('warga.show');

            // PROGRES PROYEK
            Route::get('progres', [ProgresProyekController::class, 'index'])->name('progres.index');
            Route::get('progres/{id}', [ProgresProyekController::class, 'show'])->name('progres.show');

            // LOKASI PROYEK
            Route::get('lokasi', [LokasiProyekController::class, 'index'])->name('lokasi.index');
            Route::get('lokasi/{id}', [LokasiProyekController::class, 'show'])->name('lokasi.show');

            // KONTRAKTOR
            Route::get('kontraktor', [KontraktorController::class, 'index'])->name('kontraktor.index');
            Route::get('kontraktor/{id}', [KontraktorController::class, 'show'])->name('kontraktor.show');
        });



    /*
    |--------------------------------------------------------------------------
    | PROFILE USER (SEMUA ROLE)
    |--------------------------------------------------------------------------
    */
    Route::get('profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



/*
|--------------------------------------------------------------------------
| DELETE FILES (ADMIN ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['checklogin', 'role:admin'])->group(function () {

    Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
    Route::delete('progres-proyek/file/{media_id}', [ProgresProyekController::class, 'destroyFile'])
        ->name('progres.file.delete');

    Route::delete('lokasi-proyek/{id}/file/{fileurl}', [LokasiProyekController::class, 'destroyFile'])
        ->name('lokasi.file.delete');
});
// Identitas Developer
Route::get('/identitas', [IdentitasController::class, 'index'])
    ->name('identitas');
