<?php

namespace App\Repositories\Criterion\Primitives;

use App\Repositories\Criterion\Criterion;
use Illuminate\Database\Eloquent\Builder;

class SearchLikeCriterion extends Criterion
{
    private array $keys;

    public function __construct(?array $keys = null, $value = null)
    {
        parent::__construct(value: $value);
        $this->keys = $keys;
    }

    public function apply(Builder $query): Builder
    {
        $query->where(function (Builder $query) {
            foreach ($this->keys as $key) {
                $query->orWhere($key, 'ILIKE', "%{$this->value}%");
            }
        });
        return $query;
    }

}
