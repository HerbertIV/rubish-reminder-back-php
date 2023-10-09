<?php

namespace App\Services;

use App\Services\Contracts\IcsServiceContract;
use App\Services\Contracts\ScheduleServiceContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Components\Timezone;

class IcsService implements IcsServiceContract
{
    public function __construct(
        private ScheduleServiceContract $scheduleService
    ) {
    }

    public function generate(?int $year = null): void
    {
        $year = $year ?: today()->format('Y');
        $calendar = Calendar::create()
            ->timezone(Timezone::create('europe/warsaw'))
            ->name('Zbiorka odpadów');
        $schedules = $this->scheduleService
            ->getEvents($year . '-01-01', $year . '-12-31');

        collect($schedules)->each(
            fn (array $schedule) => $calendar->event(
                Event::create()
                    ->name($schedule['title'])
                    ->description('Zbiórka śmieci: ' . $schedule['title'])
                    ->uniqueIdentifier('event-' . $schedule['id'])
                    ->createdAt(now())
                    ->startsAt(Carbon::make($schedule['start']))
                    ->fullDay()
                    ->alertMinutesBefore(420, 'Jutro zbiórka śmieci: ' . $schedule['title'])
            )
        );
        Storage::put('ICS/calendar-' . $year . '.ics', $calendar->get());
    }
}
