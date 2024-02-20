<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AddFlagToHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    /*public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }*/
    public function handle($request, Closure $next)
    {
        


        $response = $next($request);

        

       // $response->header('Flag-Name', 'Flag-Value');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        return $response;
    }
}
