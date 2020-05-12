<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if ($request->expectsJson()) {
            if(!$request->user()->isAdmin()){
                return response()->json('Unauthorized',403);
            }
            return $next($request);
        }
        abort_if(!$request->user()->isAdmin(), 403);
        return $next($request);
    }

    
    
}
