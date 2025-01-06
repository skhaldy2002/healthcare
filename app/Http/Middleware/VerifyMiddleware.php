<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->verified_by_admin){
            auth()->logout();
            return redirect()->route('login')->with([
                'error' => 'You are not verified by admin'
            ]);
        }

        return $next($request);
    }
}
