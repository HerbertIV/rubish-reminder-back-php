<?php

namespace App\Services\Contracts;

use Illuminate\Support\Collection;

interface PushMessageServiceContract
{
    public function prepareScheduleAndSend(Collection $schedules): void;
}
