<?php

namespace App\Dtos\Filters\Contracts;

use App\Repositories\Criterion\Contracts\CriterionContract;

interface FiltersDtoContract
{
    public static function init(array $data = []): self;
    public function pushToCriteria(CriterionContract $criteria): void;
    public function getCriteria(): array;
}
