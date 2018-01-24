<?php

namespace App\Modules\Stampingapproval\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'stampingapproval');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'stampingapproval');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'stampingapproval');
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
