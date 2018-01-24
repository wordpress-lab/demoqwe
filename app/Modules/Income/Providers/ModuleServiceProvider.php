<?php

namespace App\Modules\Income\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'income');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'income');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'income');
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
