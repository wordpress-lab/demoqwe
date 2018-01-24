<?php

namespace App\Modules\Musaned\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'musaned');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'musaned');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'musaned');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
