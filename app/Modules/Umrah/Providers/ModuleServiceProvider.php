<?php

namespace App\Modules\Umrah\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'umrah');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'umrah');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'umrah');
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
