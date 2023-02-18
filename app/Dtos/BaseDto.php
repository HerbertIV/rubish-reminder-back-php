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
}
