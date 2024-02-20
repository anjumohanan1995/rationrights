<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateReferer extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        $referer = $request->header('referer');


        return $next($request);
    }
}