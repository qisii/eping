<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// added
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->role_as == 1) // 1 == admin
            {
                return $next($request);
            }
            else
            {
                return redirect('/home')->with('status', 'Access Denied Not Admin');
            }
        }
        else 
        {
            return redirect('/login')->with('message', 'Please login first');
        }
    }
}
