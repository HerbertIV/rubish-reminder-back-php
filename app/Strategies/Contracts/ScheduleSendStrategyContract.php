<?php

namespace App\Strategies\Contracts;

interface ScheduleSendStrategyContract
{
    public function sendSchedule(): void;
}
