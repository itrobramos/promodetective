<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->user_type_id == 1) {
            // Pass the role to the view
            view()->share('userRole', 'admin');
            $role = 'admin';
        } 
        if (Auth::user() && Auth::user()->user_type_id == 1) {
            view()->share('userRole', 'salesperson');       
            $role = 'salesperson';     
        }
        else {
            view()->share('userRole', 'client');
            $role = 'client';
        }

        session(['userRole' => $role]);


        return $next($request);
    }
}
