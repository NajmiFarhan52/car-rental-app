<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()) //check if user logged in
        {
            if(auth()->user()->role == 1)   //check if user role is 1 (1 is admin, 0 is user)
            {
                return $next($request);
            }
        }

        return redirect()->route('user.home');
    }
}
