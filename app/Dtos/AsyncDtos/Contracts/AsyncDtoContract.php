<?php

namespace App\Dtos\AsyncDtos\Contracts;

interface AsyncDtoContract
{
    public function getTerm(): string;
    public function setTerm(?string $term): void;
}
