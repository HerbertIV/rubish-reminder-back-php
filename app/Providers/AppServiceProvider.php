<?php

namespace App\Providers;

//use Custom\Core\Resource\Providers\CoreServiceProvider;
//use Custom\Trippers\Resource\Providers\TrippersServiceProvider;
//use Custom\Regions\Resource\Providers\RegionsServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->register(RegionsServiceProvider::class);
//        $this->app->register(TrippersServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
