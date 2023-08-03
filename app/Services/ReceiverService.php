<?php

namespace App\Services;

use App\Repositories\Contracts\RegionRepositoryContract;
use App\Services\Contracts\ReceiverServiceContract;
use Illuminate\Support\Facades\DB;

class ReceiverService implements ReceiverServiceContract
{
    public function __construct(
        private RegionRepositoryContract $regionRepository
    ) {
    }

    public function setRegionToReceivers(int $regionId, array $receiversRelationData): void
    {
        $region = $this->regionRepository->where(['id' => $regionId])->first();
        if ($region) {
            DB::transaction(function () use ($receiversRelationData, $region) {
                foreach ($receiversRelationData as $relationDatum) {
                    foreach ($relationDatum as $key => $value) {
                        if ($region->$key()->whereReceiverableId($value)->count() === 0) {
                            $region->$key()->attach([$value]);
                        }
                    }
                }
            });
        }
    }
}
