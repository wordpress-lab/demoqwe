<?php

namespace App\Modules\Medicalslip\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'medicalslip');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'medicalslip');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'medicalslip');
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
