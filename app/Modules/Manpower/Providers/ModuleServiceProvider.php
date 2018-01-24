<?php

namespace App\Modules\Manpower\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'manpower');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'manpower');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'manpower');
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
