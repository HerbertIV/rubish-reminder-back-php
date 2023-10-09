<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (
            strpos(config('app.url'), 'https') !== false &&
            config('app.env') !== 'local'
        ) {
            \URL::forceScheme('https');
        }
    }
}
