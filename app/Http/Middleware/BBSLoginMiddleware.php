<?php

namespace App\Http\Middleware;

use Closure;

class BBSLoginMiddleware
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
        if(!session()->has('username')){
            return redirect(url('login'));
        }
        return $next($request);
    }
}
