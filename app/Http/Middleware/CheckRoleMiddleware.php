<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {



        // 1- check if user has one of passing roles let'
        foreach ($roles as $role) {
            if (Auth::user()->hasRole($role)) {
                return $next($request);
            }
        }



        if (Auth::user()->hasRole('admin')) {

            return redirect()->route('not.authorized');
        } elseif (Auth::user()->hasRole('restaurant owner') || Auth::user()->hasRole('operator')) {
            return redirect()->route('not.authorized');
        }
        return $next($request);
    }
}
