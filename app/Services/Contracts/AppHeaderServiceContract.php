<?php

namespace App\Services\Contracts;

use App\Dtos\AppHeadersDto;

interface AppHeaderServiceContract
{
    public function sync(AppHeadersDto $appHeadersDto): void;
}
