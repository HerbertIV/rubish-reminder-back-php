<?php

namespace App\Repositories\Contracts;


use Illuminate\Database\Eloquent\Builder;

interface TemplateRepositoryContract
{
    public function findByEvent(string $event): Builder;
}
