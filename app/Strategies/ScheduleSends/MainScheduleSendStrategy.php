<?php

namespace App\Strategies\ScheduleSends;

use App\Strategies\Contracts\ScheduleSendStrategyContract;

class MainScheduleSendStrategy
{
    public function __construct(
        private ScheduleSendStrategyContract $scheduleSendStrategy
    ){
    }

    public function sendSchedule(): void
    {
        $this->scheduleSendStrategy->sendSchedule();
    }
}
