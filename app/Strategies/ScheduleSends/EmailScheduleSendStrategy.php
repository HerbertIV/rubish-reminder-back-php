<?php

namespace App\Strategies\ScheduleSends;

use App\Services\Contracts\EmailServiceContract;
use App\Services\Contracts\ScheduleServiceContract;
use App\Strategies\Contracts\ScheduleSendStrategyContract;
use Illuminate\Support\Collection;

class EmailScheduleSendStrategy implements ScheduleSendStrategyContract
{
    private EmailServiceContract $emailService;
    private Collection $schedules;

    public function __construct(array $params) {
        $this->schedules = $params['schedules'];
        $this->emailService = app(EmailServiceContract::class);
    }

    public function sendSchedule(): void
    {
        $this->emailService->emailSend($this->schedules);
    }
}
