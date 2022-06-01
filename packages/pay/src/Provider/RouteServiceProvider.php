<?php

namespace Packages\pay\src\Provider;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->namespace($this->namespace)
                ->group(package_path('pay' , 'routes/admin.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(package_path('pay' , 'routes/web.php'));
        });
    }
}
