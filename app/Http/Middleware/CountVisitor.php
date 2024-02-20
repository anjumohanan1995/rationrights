<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Visitor;

class CountVisitor
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
        $ip = hash('sha512', $request->ip());
        $date = date("Y-m-d");
        if (Visitor::where('date', $date)->where('ip', $ip)->count() < 1)
        {
            Visitor::create([
                'date' => $date,
                'ip' => $ip,
            ]);
        }
        return $next($request);
    }
}
