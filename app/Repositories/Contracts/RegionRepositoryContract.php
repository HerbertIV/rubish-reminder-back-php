<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface RegionRepositoryContract extends BaseRepositoryContract
{
    public function search(string $term = ''): Builder;
}
