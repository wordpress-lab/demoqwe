<?php

namespace App\Modules\Flightnew\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'flightnew');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'flightnew');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'flightnew');
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
