<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        return $next($request);
        if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    foreach ($roles as $role) {
        if ($user->role === $role) {
            return $next($request);
        }
    }

    abort(403, 'Доступ запрещен');

    }
}
