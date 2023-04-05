<?php

namespace App\Dtos\AsyncDtos;

use App\Dtos\AsyncDtos\Contracts\AsyncDtoContract;
use Custom\Core\Logic\Dtos\Traits\DtoHelper;

abstract class BaseAsyncDto implements AsyncDtoContract
{
    protected ?string $term = '';

    use DtoHelper;

    public function __construct(array $data = [])
    {
        $this->setterByData($data);
    }

    public function getTerm(): string
    {
        return $this->term;
    }

    public function setTerm(?string $term): void
    {
        $this->term = $term;
    }

}
