<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use NumberToWords\NumberToWords;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        view()->share('numberTransformer',$numberTransformer);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
