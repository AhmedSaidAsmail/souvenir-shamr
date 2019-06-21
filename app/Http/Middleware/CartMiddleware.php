<?php

namespace App\Http\Middleware;

use Closure;

class CartMiddleware
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
        if(cart()->count()==0){
            return redirect("home");
        }
        return $next($request);
    }
}
