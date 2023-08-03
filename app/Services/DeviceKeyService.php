<?php

namespace App\Services;

use App\Dtos\API\CheckRegionDto;
use App\Dtos\DeviceKeyDto;
use App\Helpers\StrategyHelper;
use App\Repositories\Contracts\DeviceKeyRepositoryContract;
use App\Services\Contracts\DeviceKeyServiceContract;
use App\Strategies\Relations\MainRelationStrategy;
use Illuminate\Support\Facades\DB;

class DeviceKeyService implements DeviceKeyServiceContract
{
    public function __construct(
        private DeviceKeyRepositoryContract $deviceKeyRepository
    ) {
    }

    public function sync(?DeviceKeyDto $deviceKeyDto = null): void
    {
        if ($deviceKeyDto) {
            $deviceKey = $this->deviceKeyRepository->query()->whereDeviceKey($deviceKeyDto->getDeviceKey())->first();
            if (!$deviceKey) {

                $this->create($deviceKeyDto);
            }
        }
    }

    public function create(?DeviceKeyDto $deviceKeyDto = null): void
    {
        if ($deviceKeyDto) {
            DB::transaction(fn () => $this->deviceKeyRepository->query()->create($deviceKeyDto->toArray()));
        }
    }

    public function update(?DeviceKeyDto $deviceKeyDto = null): void
    {
        if ($deviceKeyDto) {
            DB::transaction(fn () => $this
                ->deviceKeyRepository
                ->query()
                ->whereDeviceKey($deviceKeyDto->getDeviceKey())
                ->update($deviceKeyDto->toArray()));
        }
    }

    public function checkRegions(CheckRegionDto $checkRegionDto)
    {
        foreach ($checkRegionDto->getRelations() as $relationKey => $relation) {
            StrategyHelper::makeStrategy(
                'App\Strategies\Relations\\',
                $relationKey,
                MainRelationStrategy::class,
                'setRelation',
                $relation
            );
        }
    }
}
