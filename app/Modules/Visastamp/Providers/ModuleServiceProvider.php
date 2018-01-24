<?php

namespace App\Modules\Visastamp\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'visastamp');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'visastamp');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'visastamp');
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
