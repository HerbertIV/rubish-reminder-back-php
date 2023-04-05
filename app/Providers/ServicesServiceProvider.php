<?php

namespace App\Providers;

use App\Services\AsyncService;
use App\Services\Contracts\AsyncServiceContract;
use App\Services\Contracts\RegionServiceContract;
use App\Services\Contracts\TemplateEventServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\RegionService;
use App\Services\TemplateEventService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public $singletons = [
        AsyncServiceContract::class => AsyncService::class,
        RegionServiceContract::class => RegionService::class,
        UserServiceContract::class => UserService::class,
        TemplateEventServiceContract::class => TemplateEventService::class,
    ];
}
