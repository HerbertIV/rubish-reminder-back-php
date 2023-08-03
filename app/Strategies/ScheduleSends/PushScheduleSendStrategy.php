<?php

namespace App\Strategies\ScheduleSends;

use App\Services\Contracts\PushMessageServiceContract;
use App\Strategies\Contracts\ScheduleSendStrategyContract;
use Illuminate\Support\Collection;

class PushScheduleSendStrategy implements ScheduleSendStrategyContract
{
    private PushMessageServiceContract $pushMessageService;
    private Collection $schedules;

    public function __construct(array $params) {
        $this->schedules = $params['schedules'];
        $this->pushMessageService = app(PushMessageServiceContract::class);
    }

    public function sendSchedule(): void
    {
        $this->pushMessageService->prepareScheduleAndSend($this->schedules);
    }
}
