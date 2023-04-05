<?php

namespace App\Services;

use App\Dtos\AsyncDtos\Contracts\AsyncDtoContract;
use App\Repositories\Contracts\RegionRepositoryContract;
use App\Services\Contracts\AsyncServiceContract;
use Illuminate\Support\Collection;

class AsyncService implements AsyncServiceContract
{
    public function __construct(
       private RegionRepositoryContract $regionRepository
    ) {
    }

    public function regions(AsyncDtoContract $dto): Collection
    {
        return $this->regionRepository->search($dto->getTerm())->get();
    }
}
