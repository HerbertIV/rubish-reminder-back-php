<?php

namespace App\Providers;

use App\Repositories\Contracts\RegionRepositoryContract;
use App\Repositories\RegionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public $singletons = [
        RegionRepositoryContract::class => RegionRepository::class
    ];
}
