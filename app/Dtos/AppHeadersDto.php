<?php

namespace App\Dtos;

class AppHeadersDto extends BaseDto
{
    protected string $deviceKey;
    protected string $deviceType;

    protected function setDeviceKey(string|array $deviceKey): void
    {
        $this->deviceKey = is_array($deviceKey) ?
            reset($deviceKey) :
            $deviceKey;
    }

    protected function setDeviceType(string|array $deviceType): void
    {
        $this->deviceType = is_array($deviceType) ?
            reset($deviceType) :
            $deviceType;
    }

    public function getDeviceKeyDto(): DeviceKeyDto
    {
        return DeviceKeyDto::init([
            'device_key' => $this->deviceKey,
            'device_type' => $this->deviceType,
        ]);
    }
}
