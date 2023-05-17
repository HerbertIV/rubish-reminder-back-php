<?php

namespace App\Traits;

use App\Dtos\BaseDto;
use Illuminate\Database\Eloquent\Model;

trait RelationsTrait
{
    private function setRelations(BaseDto $dto, Model $model): void
    {
        if ($dto->getRelations()) {
            // TODO in next relations
        }
    }
}
