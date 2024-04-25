<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuthenticateMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->expectsJson()) {
            return response()->json([
                'msg' => 'Unauthorized'
            ])->setStatusCode(401);
        }

        return $next($request);
    }
}
