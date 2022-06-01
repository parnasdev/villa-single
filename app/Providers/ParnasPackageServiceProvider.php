<?php


namespace App\Providers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ParnasPackageServiceProvider extends ServiceProvider
{
    /**
     * Register all service Provider my Packages
     */
    public function register()
    {
        $packages = collect(json_decode(File::get(base_path('/packages/register.json'))));

        foreach ($packages->where('disabled' , false) as $package) {
            $this->app->register($package->service);
        }
    }
}
