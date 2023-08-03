<?php

namespace App\Services\Contracts;

use App\Dtos\DeviceKeyDto;
use App\Models\DeviceKey;

interface DeviceKeyServiceContract
{
    public function sync(?DeviceKeyDto $deviceKeyDto = null): void;
    public function create(?DeviceKeyDto $deviceKeyDto = null): void;
    public function update(?DeviceKeyDto $deviceKeyDto = null): void;
}
