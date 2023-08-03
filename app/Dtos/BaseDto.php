<?php

namespace App\Dtos;

use Custom\Core\Logic\Dtos\Traits\DtoHelper;

abstract class BaseDto
{
    use DtoHelper;

    public function __construct(array $data = [])
    {
        $this->setterByData($data);
    }

    protected function setRelations(array $relations): void
    {
        $this->relations = $relations;
    }

    protected function pushToRelations(string $key, $value): void
    {
        $this->relations[$key] = $value;
    }

    public function getRelations(): array
    {
        return $this->relations ?? [];
    }

    public static function init(array $data): BaseDto
    {
        return new static($data);
    }
}
