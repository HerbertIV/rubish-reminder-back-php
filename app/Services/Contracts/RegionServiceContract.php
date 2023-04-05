<?php

namespace App\Services\Contracts;

use App\Dtos\RegionDto;
use App\Models\Region;

interface RegionServiceContract
{
    public function create(RegionDto $regionDto): Region;
    public function first(int $id): Region;
    public function deleteMany(array $ids): bool;
    public function delete(int $id): bool;
    public function update(RegionDto $regionDto, int $id): bool;
}
