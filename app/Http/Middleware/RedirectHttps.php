<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectHttps
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->secure() && env('APP_ENV') === 'prod') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
