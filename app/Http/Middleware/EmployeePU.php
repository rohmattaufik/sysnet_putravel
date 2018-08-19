<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EmployeePU
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
        if (Auth::user()->role != 3) {
            return redirect('/');
        }
        return $next($request);
    }
}