<?php

namespace App\Services;

use App\Dtos\TemplateDto;
use App\Models\Template;
use App\Repositories\Contracts\TemplateRepositoryContract;
use App\Services\Contracts\TemplateServiceContract;
use Illuminate\Support\Facades\DB;

class TemplateService implements TemplateServiceContract
{
    public function __construct(
        private TemplateRepositoryContract $templateRepository
    ) {
    }

    public function create(TemplateDto $templateDto): Template
    {
        return DB::transaction(fn () => $this->templateRepository->query()->create($templateDto->toArray()));
    }

    public function first(int $id): Template
    {
        return $this->templateRepository->where(['id' => $id])->first();
    }

    public function deleteMany(array $ids): bool
    {
        return DB::transaction(function () use ($ids) {
            foreach ($ids as $id) {
                $this->delete($id);
            }
            return true;
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(fn () => $this->templateRepository->where(['id' => $id])->delete());
    }

    public function update(TemplateDto $templateDto, int $id): bool
    {
        return DB::transaction(fn () => $this->templateRepository->where(['id' => $id])->update($templateDto->toArray()));
    }
}
