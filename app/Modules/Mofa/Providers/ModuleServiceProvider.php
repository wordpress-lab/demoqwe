<?php

namespace App\Modules\Mofa\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'mofa');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'mofa');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'mofa');
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
