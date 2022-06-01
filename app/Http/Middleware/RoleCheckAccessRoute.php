<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RoleCheckAccessRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , $name)
    {
        abort_if(!auth()->check() , 401 , 'شما ورود به سایت نکرده اید');

        switch ($name) {
            case 'panel':
                abort_if(!user()->role->is_access_panel , 403 , 'شما بهه این مسیر دسترسی ندارید');
                break;
            case 'dashboard':
                abort_if(!user()->role->is_access_dashboard , 403 , 'شما بهه این مسیر دسترسی ندارید');
                break;
            case 'custom':
                $route = explode('.' , user()->role->custom_route_name_access);
                abort_if(!str_starts_with(\Illuminate\Support\Facades\Route::currentRouteName() , $route[0]) , 403 , 'شما بهه این مسیر دسترسی ندارید');
                break;
        }

        return $next($request);
    }
}
