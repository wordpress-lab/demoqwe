<?php

namespace App\Modules\Fitcard\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'fitcard');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'fitcard');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'fitcard');
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
