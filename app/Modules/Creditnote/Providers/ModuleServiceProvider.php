<?php

namespace App\Modules\Creditnote\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'creditnote');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'creditnote');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'creditnote');
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
