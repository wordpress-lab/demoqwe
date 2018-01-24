<?php

namespace App\Modules\Manpowerservice\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'manpowerservice');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'manpowerservice');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'manpowerservice');
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
