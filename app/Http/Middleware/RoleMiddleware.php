<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // app/Http/Middleware/RoleMiddleware.php

    public function handle(Request $request, Closure $next, $role)
{
    if (Auth::check() && Auth::user()->role === $role) {
        return $next($request);
    }

    // Redirect ke halaman yang sesuai jika tidak sesuai role
        return redirect()->route('home')->with('error', 'Akses ditolak');
}

}
