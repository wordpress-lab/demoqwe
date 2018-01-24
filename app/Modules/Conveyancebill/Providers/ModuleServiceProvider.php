<?php

namespace App\Modules\Conveyancebill\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'conveyancebill');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'conveyancebill');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'conveyancebill');
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
