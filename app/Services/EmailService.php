<?php

namespace App\Services;

use App\Services\Contracts\EmailServiceContract;
use Illuminate\Support\Collection;

class EmailService implements EmailServiceContract
{
    public function emailSend(Collection $schedules): void
    {

    }
}
