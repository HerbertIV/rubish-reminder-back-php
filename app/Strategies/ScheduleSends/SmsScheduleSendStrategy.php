<?php

namespace App\Strategies\ScheduleSends;

use App\Services\Contracts\SmsServiceContract;
use App\Strategies\Contracts\ScheduleSendStrategyContract;
use Illuminate\Support\Collection;

class SmsScheduleSendStrategy implements ScheduleSendStrategyContract
{
    private SmsServiceContract $smsService;
    private Collection $schedules;

    public function __construct(array $params) {
        $this->schedules = $params['schedules'];
        $this->smsService = app(SmsServiceContract::class);
    }

    public function sendSchedule(): void
    {
        $this->smsService->smsSend($this->schedules);
    }
}
