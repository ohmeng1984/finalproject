<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Admin
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
        if(!auth()->guest()&&auth()->user()->role == 'admin'){
        return $next($request);
        } 
        return redirect('/')->with('error', 'You do not have admin access');
        
    }
}
