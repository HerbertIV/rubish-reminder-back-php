<?php

namespace App\Providers;

use App\Repositories\Contracts\RegionRepositoryContract;
use App\Repositories\Contracts\ScheduleRepositoryContract;
use App\Repositories\Contracts\TemplateRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\RegionRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public $singletons = [
        RegionRepositoryContract::class => RegionRepository::class,
        UserRepositoryContract::class => UserRepository::class,
        TemplateRepositoryContract::class => TemplateRepository::class,
        ScheduleRepositoryContract::class => ScheduleRepository::class,
    ];
}
