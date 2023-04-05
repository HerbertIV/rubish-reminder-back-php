<?php

namespace App\Services;

use App\Dtos\RegionDto;
use App\Exceptions\HasChildrenException;
use App\Models\Region;
use App\Repositories\Contracts\RegionRepositoryContract;
use App\Services\Contracts\RegionServiceContract;
use Illuminate\Support\Facades\DB;

class RegionService implements RegionServiceContract
{
    public function __construct(
        private RegionRepositoryContract $regionRepository
    ) {
    }

    public function create(RegionDto $regionDto): Region
    {
        return DB::transaction(fn () => $this->regionRepository->query()->create($regionDto->toArray()));
    }

    public function first(int $id): Region
    {
        return $this->regionRepository->where(['id' => $id])->first();
    }

    public function deleteMany(array $ids): bool
    {
        return DB::transaction(function () use ($ids) {
            foreach ($ids as $id) {
                $region = $this->regionRepository->where(['id' => $id])->first();
                if ($region->children()->count() > 0) {
                    throw new HasChildrenException();
                }
                $this->delete($id);
            }
            return true;
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(fn () => $this->regionRepository->where(['id' => $id])->delete());
    }

    public function update(RegionDto $regionDto, int $id): bool
    {
        return DB::transaction(fn () => $this->regionRepository->where(['id' => $id])->update($regionDto->toArray()));
    }
}
