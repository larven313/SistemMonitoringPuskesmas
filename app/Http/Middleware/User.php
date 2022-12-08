<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->roles == '["ADMIN"]') {
            return redirect()->route('dashboard');
        }

        if (Auth::user()->roles == '["STAFF"]') {
            return redirect()->route('dashboard');
        }

        if (Auth::user()->roles == '["USER"]') {
            return $next($request);
        }
    }
}
