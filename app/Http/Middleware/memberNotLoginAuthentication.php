<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class memberNotLoginAuthentication
{

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }else{
            return redirect()->back()->withErrors('Thao tác không đúng quy trình! Xin thử lại!');
        }
    }
}
