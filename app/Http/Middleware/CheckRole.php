<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // ADMIN boleh semuanya
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Staff atau role lain diperiksa normal
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        return abort(403, 'Anda tidak memiliki akses.');
    }
}
