<?php

namespace App\Services\Contracts;

use App\Dtos\ScheduleDto;
use App\Models\Schedule;

interface ScheduleServiceContract
{
    public function create(ScheduleDto $scheduleDto): ?Schedule;
    public function delete(int $scheduleId): bool;
    public function getEvents(string $startDate, string $endDate): array;
}
