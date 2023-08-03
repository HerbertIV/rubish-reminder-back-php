<?php

namespace App\Dtos;

class DeviceKeyDto extends BaseDto
{
    protected string $deviceKey;
    protected string $deviceType;

    protected function setDeviceKey(string $deviceKey): void
    {
        $this->deviceKey = $deviceKey;
    }

    protected function setDeviceType(string $deviceType): void
    {
        $this->deviceType = $deviceType;
    }

    public function getDeviceKey(): string
    {
        return $this->deviceKey;
    }

    public function getDeviceType(): string
    {
        return $this->deviceType;
    }

    public function toArray(): array
    {
        return [
            'device_key' => $this->deviceKey,
            'device_type' => $this->deviceType,
        ];
    }
}
