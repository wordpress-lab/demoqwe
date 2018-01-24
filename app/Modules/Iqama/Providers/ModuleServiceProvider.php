<?php

namespace App\Modules\Iqama\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'iqama');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'iqama');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'iqama');
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
