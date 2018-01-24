<?php

namespace App\Modules\Paymentreceive\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'paymentreceive');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'paymentreceive');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'paymentreceive');
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
