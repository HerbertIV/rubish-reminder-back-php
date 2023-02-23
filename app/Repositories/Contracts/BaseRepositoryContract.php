<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryContract
{
    public function makeModel(): Model;
    public function query(): Builder;
    public function where(array $params): Builder;
    public function whereIn(string $column, array $values): Builder;
}
