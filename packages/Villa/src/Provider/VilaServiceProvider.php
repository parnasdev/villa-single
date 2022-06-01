<?php


namespace Packages\Villa\src\Provider;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Packages\villa\src\command\VilaInstall;
use Packages\Villa\src\Http\Livewire\Admin\AddPage;
use Packages\Villa\src\Http\Livewire\Admin\EditPage;
use Packages\Villa\src\Http\Livewire\Admin\ListPage;
use Packages\Villa\src\Http\Livewire\Admin\PriceManagement;
use Packages\Villa\src\Http\Livewire\Admin\ReserveInfo;
use Packages\Villa\src\Http\Livewire\Admin\ReservesPage;
use Packages\Villa\src\Http\Livewire\Home\IndexPage;
use Packages\Villa\src\Http\Livewire\Home\InfoPage;
use Packages\Villa\src\Http\Livewire\Home\ReservePage;


use Packages\Villa\src\Http\Livewire\Admin\ReservesPanel;
use Packages\Villa\src\Http\Livewire\Admin\ReserveInfoPanel;
use Packages\Villa\src\Http\Livewire\Dashboard\ReserveInfoDashboard;
use Packages\Villa\src\Http\Livewire\Dashboard\Reserves;

class VilaServiceProvider extends ServiceProvider
{

    /**
     * @var string $$this->packageName
     */
    protected $packageName = 'Villa';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerCommand();
        $this->registerConfig();
        $this->registerViews();
        $this->registerLivewire();
        $this->registerComponents();
        $this->loadMigrationsFrom(package_path($this->packageName, 'database/migrations'));

        $sidebar = config('sidebar');

        if (config('academy.sidebar')) {
            $sidebar[] = config('academy.sidebar');
            config()->set('sidebar' , $sidebar);
        }

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            package_path($this->packageName, 'config/vila.php' , true) => config_path($this->packageName . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            package_path($this->packageName, 'config/vila.php' , true), 'vila'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/packages/' . $this->packageName);

        $sourcePath = package_path($this->packageName, 'resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->packageName . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->packageName);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/packages/' . $this->packageName);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->packageName);
        } else {
            $this->loadTranslationsFrom(package_path($this->packageName, 'resources/lang'), $this->packageName);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path . '/packages/' . $this->packageName)) {
                $paths[] = $path . '/packages/' . $this->packageName;
            }
        }
        return $paths;
    }

    public function registerCommand()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                VilaInstall::class,
            ]);
        }
    }

    public function registerLivewire()
    {
        Livewire::component('villa-add', AddPage::class);
        Livewire::component('villa-edit', EditPage::class);
        Livewire::component('villa-list', ListPage::class);
        Livewire::component('villa-reserves', ReservesPage::class);
        Livewire::component('villa-reserveInfo', ReserveInfo::class);
        Livewire::component('villa-info', InfoPage::class);
        Livewire::component('price-management', PriceManagement::class);
        Livewire::component('villa-index', IndexPage::class);
        Livewire::component('villa-reserve', ReservePage::class);

        Livewire::component('villa-reserve-panel', ReservesPanel::class);
        Livewire::component('villa-reserve-info-panel', ReserveInfoPanel::class);


        Livewire::component('villa-reserve-dashboard', Reserves::class);
        Livewire::component('villa-reserve-info-dashborad', ReserveInfoDashboard::class);


//        Livewire::component('season-index', SeasonIndex::class);
//        Livewire::component('episode-index', EpisodeIndex::class);
//        Livewire::component('arvan-uploader', ArvanUploader::class);
//        Livewire::component('academy-setting', AcademySetting::class);

//        Livewire::component('info-course', \Packages\academy\src\Http\Livewire\Home\InfoCourse::class);
//        Livewire::component('list-course', \Packages\academy\src\Http\Livewire\Home\ListCourse::class);
    }

    public function registerComponents()
    {
//        $this->loadViewComponentsAs($this->packageName, [
//
//        ]);
    }

}
