<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenLifetimeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->tokenExpired()){
            $request->user()->tokens()->delete();
            return response('Token Expired.', 401);
        }
        return $next($request);
    }
}
