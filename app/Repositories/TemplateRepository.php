<?php

namespace App\Repositories;

use App\Models\Template;
use App\Repositories\Contracts\TemplateRepositoryContract;
use Illuminate\Database\Eloquent\Builder;

class TemplateRepository extends BaseRepository implements TemplateRepositoryContract
{
    public function model(): string
    {
        return Template::class;
    }

    public function findByEvent(string $event): Builder
    {
        return $this->query()->whereEventName($event);
    }
}
