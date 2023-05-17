<?php

namespace App\Dtos;

class ScheduleDto extends BaseDto
{
    protected int $placeableId;
    protected string $placeableType;
    protected string $garbageType;
    protected string $executeDatetime;

    public function getPlaceableId(): int
    {
        return $this->placeableId;
    }

    public function getPlaceableType(): string
    {
        return $this->placeableType;
    }

    public function getGarbageType(): string
    {
        return $this->garbageType;
    }

    public function getExecuteDatetime(): string
    {
        return $this->executeDatetime;
    }

    public function toArray(): array
    {
        return [
            'placeable_id' => $this->getPlaceableId(),
            'placeable_type' => $this->getPlaceableType(),
            'garbage_type' => $this->getGarbageType(),
            'execute_datetime' => $this->getExecuteDatetime()
        ];
    }

    protected function setPlaceableId(int $placeableId): void
    {
        $this->placeableId = $placeableId;
    }

    protected function setPlaceableType(string $placeableType): void
    {
        $this->placeableType = $placeableType;
    }

    protected function setGarbageType(string $garbageType): void
    {
        $this->garbageType = $garbageType;
    }

    protected function setExecuteDatetime(string $executeDatetime): void
    {
        $this->executeDatetime = $executeDatetime;
    }
}
