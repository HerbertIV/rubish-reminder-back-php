<?php

namespace App\Repositories\Criterion;

use App\Repositories\Criterion\Contracts\CriterionContract;
use Illuminate\Database\Eloquent\Builder;

abstract class Criterion implements CriterionContract
{
    protected ?string $key;
    protected $value;
    protected $operator;

    public function __construct(?string $key = null, $value = null, $operator = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->operator = $operator;
    }

    abstract public function apply(Builder $query): Builder;
}

