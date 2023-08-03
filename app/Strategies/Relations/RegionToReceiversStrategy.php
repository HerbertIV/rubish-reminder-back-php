<?php

namespace App\Strategies\Relations;

use App\Services\Contracts\ReceiverServiceContract;
use App\Strategies\Contracts\RelationStrategyContract;

class RegionToReceiversStrategy implements RelationStrategyContract
{
    private int $regionId;
    private array $receivers;
    private ReceiverServiceContract $receiverService;

    public function __construct(array $relationsData)
    {
        $this->regionId = $relationsData['region_id'];
        $this->receivers = $relationsData['receivers'];
        $this->receiverService = app(ReceiverServiceContract::class);
    }

    public function setRelation(): void
    {
        $this->receiverService->setRegionToReceivers($this->regionId, $this->receivers);
    }
}
