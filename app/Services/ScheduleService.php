<?php

namespace App\Services;

use App\Dtos\ScheduleDto;
use App\Models\Schedule;
use App\Repositories\Contracts\ScheduleRepositoryContract;
use App\Services\Contracts\ScheduleServiceContract;
use Illuminate\Support\Carbon;
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

    public function getEvents(string $startDate, string $endDate): array
    {
        return $this->scheduleRepository->query()->where([
            ['execute_datetime', '<=', $endDate],
            ['execute_datetime', '>=', $startDate],
        ])->get()->map(fn (Schedule $schedule) => [
            'title' => $schedule->garbage_type . ' - ' . $schedule->placeable->name,
            'start' => Carbon::make($schedule->execute_datetime)->format('Y-m-d'),
            'id' => $schedule->getKey()
        ])->toArray();
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
