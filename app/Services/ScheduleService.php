<?php

namespace App\Services;

use App\Repositories\Contracts\ScheduleRepositoryContract;
use App\Services\Contracts\ScheduleServiceContract;

class ScheduleService implements ScheduleServiceContract
{
    public function __construct(
        private ScheduleRepositoryContract $scheduleRepository
    ) {
    }
}
