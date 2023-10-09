<?php

namespace App\Services\Contracts;

interface IcsServiceContract
{
    public function generate(?int $year = null): void;
}
