<?php

namespace App\Modules\Accountchart\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'accountchart');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'accountchart');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'accountchart');
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
