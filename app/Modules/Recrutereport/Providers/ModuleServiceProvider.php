<?php

namespace App\Modules\Recrutereport\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'recrutereport');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'recrutereport');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'recrutereport');
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
