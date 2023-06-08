<?php

namespace App\Services;

use App\Dtos\AppHeadersDto;
use App\Services\Contracts\AppHeaderServiceContract;
use App\Services\Contracts\DeviceKeyServiceContract;

class AppHeaderService implements AppHeaderServiceContract
{
    public function __construct(
        private DeviceKeyServiceContract $deviceKeyService
    ) {
    }

    public function sync(AppHeadersDto $appHeadersDto): void
    {
        $this->deviceKeyService->sync($appHeadersDto->getDeviceKeyDto());
    }
}
