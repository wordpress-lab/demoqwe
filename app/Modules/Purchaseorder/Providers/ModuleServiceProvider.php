<?php

namespace App\Modules\Purchaseorder\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'purchaseorder');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'purchaseorder');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'purchaseorder');
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
