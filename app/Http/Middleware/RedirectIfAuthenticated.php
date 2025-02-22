<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle($request, Closure $next, ...$guards)
{
    $guard = $guards[0] ?? config('auth.defaults.guard');

    if (Auth::guard($guard)->check()) {
        return $guard === 'admin' ? redirect('/admin/top') : redirect('/user/top'); // ✅ ユーザーと管理者で分岐
    }

    return $next($request);
}

}
