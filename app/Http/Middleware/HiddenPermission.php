<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class HiddenPermission
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
        if(!checkPermissionAccess()){
            $userLoggedIn = Sentinel::getUser();
            if(!$userLoggedIn){
                return redirect()->route('login');
            }

            abort(404);
        }
        return $next($request);
    }
}
