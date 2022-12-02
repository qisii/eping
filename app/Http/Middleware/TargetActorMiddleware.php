<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// added
use Illuminate\Support\Facades\Auth;

class TargetActorMiddleware
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
            if(Auth::user()->role_as == 0 ) 
            {
                if(Auth::user()->status == 1)
                {
                    return $next($request);
                }
                else
                {
                    return redirect('/home')->with('status', 'You are banned');
                }
                
            }
            else
            {
                return redirect('/home')->with('status', 'Access Denied not User');
            }
        }
        else 
        {
            return redirect('/login')->with('message', 'Please login first');
        }
        return $next($request);
    }
}
