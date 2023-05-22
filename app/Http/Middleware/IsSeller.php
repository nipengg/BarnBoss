<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IsSeller
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() && Auth::user()->role == 2)
        {
            return $next($request);
        }
        return redirect('/');
    }
}
