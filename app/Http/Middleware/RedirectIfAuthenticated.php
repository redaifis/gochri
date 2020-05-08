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
        
        if (Auth::guard($guard)->check()) {
            if($request->user()->role == 'admin'){
                return redirect(RouteServiceProvider::ADMIN);
            }
            if($request->user()->role == 'customer'){
                return redirect(RouteServiceProvider::CUSTOMER);
            }
            if($request->user()->role == 'supplier'){
                return redirect(RouteServiceProvider::SUPPLIER);
            }
        }

        return $next($request);
    }
}
