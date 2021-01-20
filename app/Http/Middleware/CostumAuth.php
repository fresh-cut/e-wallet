<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CostumAuth
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
        if (!empty(session('authenticated')) && !empty(session('_token'))) {
            $request->session()->put('authenticated', time());
            return $next($request);
        }
        return redirect()->route('admin.login.index');
    }
}
