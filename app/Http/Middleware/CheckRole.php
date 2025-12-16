<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors('Silahkan login terlebih dahulu!');
        }

        // Ambil role user saat ini
        $userRole = Auth::user()->role;

        // Jika role user tidak ada dalam daftar role yang diperbolehkan
        if (!in_array($userRole, $roles)) {
            return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
