<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch('role'){
                case 'ADMIN':
                 return redirect('/admin/dashboard');

                 case 'CASHIER':
                 return redirect('/cashier/dashboard');

                 case 'INVENTORY':
                 return redirect('/inventory/dashboard');
            }
        }

        return $next($request);
    }
}
