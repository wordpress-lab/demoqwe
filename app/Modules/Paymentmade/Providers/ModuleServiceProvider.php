<?php

namespace App\Modules\Paymentmade\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'paymentmade');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'paymentmade');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'paymentmade');
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
