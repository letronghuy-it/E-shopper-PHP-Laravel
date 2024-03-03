<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Adminentication
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level == 1) {
            return $next($request);
        } else {
            Auth::logout();
            return redirect('/admin/login');
        }
    }
}
