<?php

namespace App\Modules\Kafala\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'kafala');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'kafala');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'kafala');
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
