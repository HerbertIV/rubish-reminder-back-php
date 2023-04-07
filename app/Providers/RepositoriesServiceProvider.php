<?php

namespace App\Providers;

use App\Repositories\Contracts\RegionRepositoryContract;
use App\Repositories\Contracts\TemplateRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\RegionRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\ScheduleServiceContract;
use App\Services\ScheduleService;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public $singletons = [
        RegionRepositoryContract::class => RegionRepository::class,
        UserRepositoryContract::class => UserRepository::class,
        TemplateRepositoryContract::class => TemplateRepository::class,
        ScheduleServiceContract::class => ScheduleService::class,
    ];
}
