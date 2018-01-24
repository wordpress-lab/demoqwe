<?php

namespace App\Modules\Recurringexpense\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'recurringexpense');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'recurringexpense');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'recurringexpense');
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
