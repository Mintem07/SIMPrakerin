<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsPembimbing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki role 'pembimbing'
        if (Auth::check() && Auth::user()->role === 'pembimbing') {
            return $next($request);
        }

        return redirect('/anda-tidak-memiliki-akses')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
