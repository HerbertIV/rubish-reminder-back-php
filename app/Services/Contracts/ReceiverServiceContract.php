<?php

namespace App\Services\Contracts;

interface ReceiverServiceContract
{
    public function setRegionToReceivers(int $regionId, array $receiversRelationData): void;
}
