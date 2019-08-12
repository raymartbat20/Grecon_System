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
<<<<<<< HEAD
            return redirect('/home');
=======
            switch('role'){
                case 'ADMIN':
                 return redirect('/admin/dashboard');

                 case 'CASHIER':
                 return redirect('/cashier/dashboard');

                 case 'INVENTORY':
                 return redirect('/inventory/dashboard');
            }
>>>>>>> 2ce7d968c0d71d605fc807dcc8275f0bafeec62b
        }

        return $next($request);
    }
}
