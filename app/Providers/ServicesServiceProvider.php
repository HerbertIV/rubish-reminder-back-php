<?php

namespace App\Providers;

use App\Services\AppHeaderService;
use App\Services\AsyncService;
use App\Services\Contracts\AppHeaderServiceContract;
use App\Services\Contracts\AsyncServiceContract;
use App\Services\Contracts\DeviceKeyServiceContract;
use App\Services\Contracts\PushMessageServiceContract;
use App\Services\Contracts\RegionServiceContract;
use App\Services\Contracts\ScheduleServiceContract;
use App\Services\Contracts\TemplateEventServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\DeviceKeyService;
use App\Services\PushMessageService;
use App\Services\RegionService;
use App\Services\ScheduleService;
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
        ScheduleServiceContract::class => ScheduleService::class,
        DeviceKeyServiceContract::class => DeviceKeyService::class,
        AppHeaderServiceContract::class => AppHeaderService::class,
        PushMessageServiceContract::class => PushMessageService::class,
    ];
}
