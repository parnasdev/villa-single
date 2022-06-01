<?php

namespace App\PrsAuth;

use App\PrsAuth\Services\PrsAuthenticateService;
use Illuminate\Support\ServiceProvider;

class PrsAuthenticateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('prsauth' , function () {
            return new PrsAuthenticateService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
