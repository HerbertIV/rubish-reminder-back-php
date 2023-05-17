<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Repositories\Contracts\ScheduleRepositoryContract;

class ScheduleRepository extends BaseRepository implements ScheduleRepositoryContract
{
    public function model(): string
    {
        return Schedule::class;
    }
}
