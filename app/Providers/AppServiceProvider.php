<?php

namespace App\Providers;

use App\Console\Commands\InstallCMS;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCMS::class,
            ]);
        }

        Schema::defaultStringLength('244');

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $options = [];
//        foreach (Setting::query()->get() ?? [] as $item) {
//            $options[$item->name] = $item->value;
//        }
//
//        config()->set('options', $options);
    }
}
