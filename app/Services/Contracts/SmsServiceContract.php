<?php

namespace App\Services\Contracts;

use Illuminate\Support\Collection;

interface SmsServiceContract
{
    public function smsSend(Collection $schedules): void;
}
