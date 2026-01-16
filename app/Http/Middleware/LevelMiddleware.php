<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LevelMiddleware
{
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // Jika tidak login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika middleware dipanggil TANPA parameter level
        if (empty($levels)) {
            return $next($request);
        }

        // Cek level user
        if (!in_array(Auth::user()->level, $levels)) {
            abort(404); // admin-only → tampilkan not found
        }

        return $next($request);
    }
}