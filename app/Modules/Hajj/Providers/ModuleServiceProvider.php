<?php

namespace App\Modules\Hajj\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'hajj');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'hajj');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'hajj');
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
