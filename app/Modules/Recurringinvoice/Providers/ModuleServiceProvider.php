<?php

namespace App\Modules\Recurringinvoice\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'recurringinvoice');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'recurringinvoice');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'recurringinvoice');
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
