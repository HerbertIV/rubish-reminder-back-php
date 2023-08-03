<?php

namespace App\Dtos\API;

use App\Dtos\BaseDto;
use App\Models\DeviceKey;
use App\Repositories\Contracts\DeviceKeyRepositoryContract;

class CheckRegionDto extends BaseDto
{
    protected int $regionId;
    protected string $deviceKey;
    protected string $deviceType;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->pushToRelations('RegionToReceivers', [
            'receivers' => [
                ['deviceKeys' => $this->getDeviceKeyModel()?->getKey()],
            ],
            'region_id' => $this->regionId,
        ]);
    }

    public function getDeviceKeyModel(): ?DeviceKey
    {
        return app(DeviceKeyRepositoryContract::class)->where([
            'device_key' => $this->deviceKey,
            'device_type' => $this->deviceType
        ])->first();
    }

    protected function setRegionId(int $regionId): void
    {
        $this->regionId = $regionId;
    }

    protected function setDeviceKey(string $deviceKey): void
    {
        $this->deviceKey = $deviceKey;
    }

    protected function setDeviceType(string $deviceType): void
    {
        $this->deviceType = $deviceType;
    }
}
