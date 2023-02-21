<?php

namespace App\Providers;

use App\Services\AsyncService;
use App\Services\Contracts\AsyncServiceContract;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public $singletons = [
        AsyncServiceContract::class => AsyncService::class
    ];
}
