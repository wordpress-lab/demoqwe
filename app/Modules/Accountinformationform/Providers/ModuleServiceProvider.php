<?php

namespace App\Modules\Accountinformationform\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'accountinformationform');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'accountinformationform');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'accountinformationform');
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
