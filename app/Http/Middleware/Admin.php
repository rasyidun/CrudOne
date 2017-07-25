<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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

        if(Auth::check()){//if the login user // check if the user is logged in

            if(Auth::user()->isAdmin()){ //if the Auth user is admin

                return $next($request); //go for the next request of the application
            }

        }

        return redirect('/'); //if for some reason the user is not logged in, go to Homepage


    }
}
