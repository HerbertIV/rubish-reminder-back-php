<?php

namespace App\Services\Contracts;

use App\Dtos\TemplateDto;
use App\Models\Template;

interface TemplateServiceContract
{
    public function create(TemplateDto $templateDto): Template;
    public function first(int $id): Template;
    public function deleteMany(array $ids): bool;
    public function delete(int $id): bool;
    public function update(TemplateDto $templateDto, int $id): bool;
}
