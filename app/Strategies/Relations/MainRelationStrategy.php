<?php

namespace App\Strategies\Relations;

use App\Strategies\Contracts\RelationStrategyContract;

abstract class MainRelationStrategy
{
    public function __construct(
        private RelationStrategyContract $relationStrategy
    ) {
    }

    public function setRelation(): void
    {
        $this->relationStrategy->setRelation();
    }
}
