<?php

namespace App\Repositories\Contracts;

use App\Dtos\Filters\Contracts\FiltersDtoContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryContract
{
    public function makeModel(): Model;
    public function query(): Builder;
    public function where(array $params): Builder;
    public function whereIn(string $column, array $values): Builder;
    public function queryWithCriteria(?FiltersDtoContract $filtersDto = null): Builder;
    public function applyCriteria(Builder $query, array $criteria): Builder;
}
