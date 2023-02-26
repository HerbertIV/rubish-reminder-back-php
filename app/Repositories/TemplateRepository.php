<?php

namespace App\Repositories;

use App\Models\Template;
use App\Repositories\Contracts\TemplateRepositoryContract;

class TemplateRepository extends BaseRepository implements TemplateRepositoryContract
{
    public function model(): string
    {
        return Template::class;
    }
}
