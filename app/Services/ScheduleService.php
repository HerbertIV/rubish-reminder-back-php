<?php

namespace App\Services;

use App\Dtos\ScheduleDto;
use App\Events\Templates\Sms\SmsReminderEventEvent;
use App\Models\Region;
use App\Models\Schedule;
use App\Repositories\Contracts\ScheduleRepositoryContract;
use App\Services\Contracts\ScheduleServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ScheduleService implements ScheduleServiceContract
{
    public function __construct(
        private ScheduleRepositoryContract $scheduleRepository
    ) {
    }

    public function create(ScheduleDto $scheduleDto): ?Schedule
    {
        return $this->canCreate($scheduleDto) ?
            DB::transaction(fn () => $this->scheduleRepository->query()->create($scheduleDto->toArray()))
            : null;
    }

    public function delete(int $scheduleId): bool
    {
        return DB::transaction(fn () => $this->scheduleRepository->query()->whereId($scheduleId)->delete());
    }

    public function getEvents(string $startDate, string $endDate, array $placeables = []): array
    {
        $query = $this->scheduleRepository->query()
            ->when(
                !empty($placeables),
                function (Builder $query) use ($placeables) {
                    foreach ($placeables as $key => $value) {
                        $query->whereHasMorph(
                            'placeable',
                            $key,
                            fn (Builder $query) => $query->whereIn('id', $value)
                        );
                    }
                }
            )
            ->where([
                ['execute_datetime', '<=', $endDate],
                ['execute_datetime', '>=', $startDate],
            ]);
        return $query->get()->map(fn (Schedule $schedule) => [
            'title' => $schedule->garbage_type . ' - ' . $schedule->placeable->name,
            'start' => Carbon::make($schedule->execute_datetime)->format('Y-m-d'),
            'id' => $schedule->getKey()
        ])->toArray();
    }

    public function reminderSchedule(): void
    {
        $schedules = $this->scheduleRepository
            ->query()
            ->where('execute_datetime', '=', now()->format('Y-m-d'))
            ->get();
        $this->smsSend($schedules);
    }

    private function smsSend(Collection $schedules): void
    {
        foreach ($schedules as $schedule) {
            dd($schedule->placeable);
            /* @var Schedule $schedule */
            event(new SmsReminderEventEvent($schedule->placeable));
        }
    }

    private function emailSend(Collection $schedules): void
    {

    }

    private function canCreate(ScheduleDto $scheduleDto): bool
    {
        return !$this->scheduleRepository->query()->where([
            'placeable_type' => $scheduleDto->getPlaceableType(),
            'placeable_id' => $scheduleDto->getPlaceableId(),
            'garbage_type' => $scheduleDto->getGarbageType(),
            'execute_datetime' => $scheduleDto->getExecuteDatetime()
        ])->count();
    }
}
