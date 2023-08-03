<?php

declare(strict_types = 1);

namespace App\Events\Templates;

use App\Models\Schedule;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

abstract class CommonReminderEventEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private Collection $receivers,
        private Schedule $schedule
    ) {
    }

    public function getReceivers(): Collection
    {
        return $this->receivers;
    }

    public function getSchedule(): Schedule
    {
        return $this->schedule;
    }
}
