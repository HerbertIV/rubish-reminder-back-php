<?php

namespace App\Repositories;

use App\Models\DeviceKey;
use App\Repositories\Contracts\DeviceKeyRepositoryContract;

class DeviceKeyRepository extends BaseRepository implements DeviceKeyRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return DeviceKey::class;
    }

}
