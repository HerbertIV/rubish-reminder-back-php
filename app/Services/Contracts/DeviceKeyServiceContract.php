<?php

namespace App\Services\Contracts;

use App\Dtos\DeviceKeyDto;
use App\Models\DeviceKey;

interface DeviceKeyServiceContract
{
    public function sync(DeviceKeyDto $deviceKeyDto): DeviceKey;
    public function create(DeviceKeyDto $deviceKeyDto): DeviceKey;
    public function update(DeviceKeyDto $deviceKeyDto): DeviceKey;
}
