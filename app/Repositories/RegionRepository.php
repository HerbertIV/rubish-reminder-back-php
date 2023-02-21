<?php

namespace App\Repositories;

use App\Models\Region;
use App\Repositories\Contracts\RegionRepositoryContract;
use Illuminate\Database\Eloquent\Builder;

class RegionRepository extends BaseRepository implements RegionRepositoryContract
{
    public function model()
    {
        return Region::class;
    }

    public function search(string $term = ''): Builder
    {
        $query = $this->model->newQuery();
        $query->where('name', 'like', "%$term%");
        return $query;
    }
}
