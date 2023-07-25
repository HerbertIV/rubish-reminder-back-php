<?php

namespace App\Dtos\Filters;

use App\Dtos\Filters\Contracts\FiltersDtoContract;
use App\Repositories\Criterion\Contracts\CriterionContract;
use App\Repositories\Criterion\Primitives\SearchLikeCriterion;
use Custom\Core\Logic\Dtos\Traits\DtoHelper;

class RegionFiltersDto implements FiltersDtoContract
{
    use DtoHelper;

    /**
     * @var CriterionContract[]
     */
    protected array $criteria;
    protected string $q;

    public function __construct(array $data = [])
    {
        $this->setterByData($data);
    }

    public static function init(array $data = []): self
    {
        $dto = new self($data);
        if ($dto->getQ()) {
            $dto->pushToCriteria(new SearchLikeCriterion(['name'], $dto->getQ()));
        }

        return $dto;
    }

    public function pushToCriteria(CriterionContract $criteria): void
    {
        $this->criteria[] = $criteria;
    }

    public function getCriteria(): array
    {
        return $this->criteria ?? [];
    }

    public function getQ(): string
    {
        return $this->q ?? '';
    }

    protected function setQ(string $q): void
    {
        $this->q = $q;
    }
}
