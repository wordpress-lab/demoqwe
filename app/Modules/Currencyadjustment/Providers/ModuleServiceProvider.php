<?php

namespace App\Modules\Currencyadjustment\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'currencyadjustment');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'currencyadjustment');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'currencyadjustment');
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
