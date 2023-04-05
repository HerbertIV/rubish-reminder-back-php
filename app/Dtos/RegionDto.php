<?php

namespace App\Dtos;

class RegionDto extends BaseDto
{
    protected string $name;
    protected ?int $parentId;

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentId(): ?int
    {
        return $this->parentId ?? null;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'parent_id' => $this->getParentId(),
        ];
    }

    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    protected function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }
}
