<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class AuthenticateMiddleware{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
