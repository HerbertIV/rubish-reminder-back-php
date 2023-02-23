<?php

namespace App\Providers;

use App\Services\AsyncService;
use App\Services\Contracts\AsyncServiceContract;
use App\Services\Contracts\RegionServiceContract;
use App\Services\RegionService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public $singletons = [
        AsyncServiceContract::class => AsyncService::class,
        RegionServiceContract::class => RegionService::class
    ];
}
