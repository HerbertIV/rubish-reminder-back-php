<?php

namespace App\Services;

use App\Events\Templates\Sms\SmsReminderEventEvent;
use App\Models\Schedule;
use App\Services\Contracts\SmsServiceContract;
use Illuminate\Support\Collection;

class SmsService implements SmsServiceContract
{
    public function smsSend(Collection $schedules): void
    {
        foreach ($schedules as $schedule) {
            /* @var Schedule $schedule */
            foreach ($schedule->placeable->users as $user) {
                event(new SmsReminderEventEvent(
                    $user,
                    $schedule
                ));
            }
        }
    }
}
