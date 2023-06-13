<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->nombre === 'admin') {
            return $next($request);
        }

        return redirect('/');
    }
}