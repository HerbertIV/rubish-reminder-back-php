<?php

namespace App\Services;

use App\Dtos\DeviceKeyDto;
use App\Models\DeviceKey;
use App\Repositories\Contracts\DeviceKeyRepositoryContract;
use App\Services\Contracts\DeviceKeyServiceContract;
use Illuminate\Support\Facades\DB;

class DeviceKeyService implements DeviceKeyServiceContract
{
    public function __construct(
        private DeviceKeyRepositoryContract $deviceKeyRepository
    ) {
    }

    public function sync(DeviceKeyDto $deviceKeyDto): DeviceKey
    {
        $deviceKey = $this->deviceKeyRepository->query()->whereDeviceKey($deviceKeyDto->getDeviceKey())->first();
        if (!$deviceKey) {

            return $this->create($deviceKeyDto);
        }

        return $deviceKey;
    }

    public function create(DeviceKeyDto $deviceKeyDto): DeviceKey
    {
        return DB::transaction(fn () => $this->deviceKeyRepository->query()->create($deviceKeyDto->toArray()));
    }

    public function update(DeviceKeyDto $deviceKeyDto): DeviceKey
    {
        return DB::transaction(fn () => $this
            ->deviceKeyRepository
            ->query()
            ->whereDeviceKey($deviceKeyDto->getDeviceKey())
            ->update($deviceKeyDto->toArray()));
    }
}
