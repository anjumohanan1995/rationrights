<?php

namespace App\Http\Middleware;

use Closure;

class RemoveSetCookieHeader
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        $response->headers->remove('Set-Cookie');
 
        return $response;
    }
}
