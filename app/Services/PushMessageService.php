<?php

namespace App\Services;

use App\Events\Templates\Push\PushReminderEventEvent;
use App\Models\Schedule;
use App\Services\Contracts\PushMessageServiceContract;
use Illuminate\Support\Collection;

class PushMessageService implements PushMessageServiceContract
{
    public function prepareScheduleAndSend(Collection $schedules): void
    {
        foreach ($schedules as $schedule) {
            /* @var Schedule $schedule */
            event(new PushReminderEventEvent(
                $schedule->placeable->deviceKeys,
                $schedule
            ));
        }
    }
}
