<?php

namespace App\Dtos;

class AppHeadersDto extends BaseDto
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

    public function getDeviceKeyDto(): DeviceKeyDto
    {
        return DeviceKeyDto::init([
            'device_key' => $this->deviceKey,
            'device_type' => $this->deviceType,
        ]);
    }
}
