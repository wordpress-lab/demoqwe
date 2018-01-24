<?php

namespace App\Modules\Vendorcredit\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'vendorcredit');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'vendorcredit');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'vendorcredit');
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
