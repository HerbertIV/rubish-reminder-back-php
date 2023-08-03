<?php

namespace App\Services\Contracts;

use Illuminate\Support\Collection;

interface EmailServiceContract
{
    public function emailSend(Collection $schedules): void;
}
