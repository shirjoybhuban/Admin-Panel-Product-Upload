<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ((Auth::guard($guard)->check() && Auth::user()->user_type == 'admin') || Auth::guard($guard)->check() && Auth::user()->user_type == 'staff') {
            return redirect('admin/dashboard');
        }
        elseif (Auth::guard($guard)->check() && Auth::user()->user_type == 'customer'){
            return redirect('user/dashboard');
        }elseif (Auth::guard($guard)->check() && Auth::user()->user_type == 'seller'){
            return redirect('seller/dashboard');
        }else{
            return $next($request);
        }
    }
}
