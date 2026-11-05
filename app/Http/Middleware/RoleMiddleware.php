<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        $user = $request->user();

        if (! $user) {
            abort(401);
        }

        // Admin boleh mengakses semua route yang menggunakan middleware role.
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Periksa role pengguna lainnya.
        if (! in_array($user->role, $roles, true)) {
            abort(403, 'Kamu tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}