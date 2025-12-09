<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontraktorController;
use App\Http\Controllers\LokasiProyekController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgresProyekController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\TahapanProyekController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// AUTH
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

Route::middleware(['checkislogin'])->group(function () {

    // Dashboard (semua user login lihat)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ADMIN: full CRUD
    Route::middleware(['checkrole:admin'])->group(function () {
        Route::resource('proyek', ProyekController::class);
        Route::resource('user', UserController::class);
        Route::resource('tahapan', TahapanProyekController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('progres_proyek', ProgresProyekController::class);
        Route::resource('lokasi', LokasiProyekController::class);
        Route::resource('kontraktor', KontraktorController::class);
    });

    // STAFF & USER: hanya read (index & show)
    Route::middleware(['checkrole:staff,user'])->group(function () {
        Route::get('proyek', [ProyekController::class, 'index'])->name('proyek.index');
        Route::get('proyek/{id}', [ProyekController::class, 'show'])->name('proyek.show');

        Route::get('tahapan', [TahapanProyekController::class, 'index'])->name('tahapan.index');
        Route::get('tahapan/{id}', [TahapanProyekController::class, 'show'])->name('tahapan.show');

        Route::get('warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('warga/{id}', [WargaController::class, 'show'])->name('warga.show');

        Route::get('progres_proyek', [ProgresProyekController::class, 'index'])->name('progres_proyek.index');
        Route::get('progres_proyek/{id}', [ProgresProyekController::class, 'show'])->name('progres_proyek.show');

        Route::get('lokasi', [LokasiProyekController::class, 'index'])->name('lokasi.index');
        Route::get('lokasi/{id}', [LokasiProyekController::class, 'show'])->name('lokasi.show');

        Route::get('kontraktor', [KontraktorController::class, 'index'])->name('kontraktor.index');
        Route::get('kontraktor/{id}', [KontraktorController::class, 'show'])->name('kontraktor.show');
    });

    // Profile routes (login user bisa akses)
    Route::get('profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
