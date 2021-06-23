<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'publisher') ) {
            return $next($request);
        }
        else{
            session(['link' => url()->current()]);
            return redirect()->route('login');
        }
    }
}
