<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoginCustomer
{
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('id')) {
            return redirect()->route('home.login');
        }
        return $next($request);
    }
}
