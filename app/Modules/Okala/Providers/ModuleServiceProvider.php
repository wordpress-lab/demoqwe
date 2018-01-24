<?php

namespace App\Modules\Okala\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'okala');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'okala');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'okala');
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
