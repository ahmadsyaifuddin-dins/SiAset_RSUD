<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah role user saat ini ada di dalam daftar role yang diizinkan
        if (! in_array($request->user()->role, $roles)) {
            abort(403, 'Akses Ditolak. Halaman ini khusus Admin.');
        }

        return $next($request);
    }
}
