<?php

namespace App\Modules\Fingerprint\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'fingerprint');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'fingerprint');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'fingerprint');
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
