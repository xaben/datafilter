<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

use Xaben\DataFilter\Definition\FilterDefinition;

class CollectionFilter
{
    protected FilterDefinition $definition;

    protected array $defaultCriteria;

    protected array $userCriteria;

    protected array $predefinedCriteria;

    protected array $sortOrder;

    protected int $offset;

    protected int $limit;

    public function __construct(FilterDefinition $definition)
    {
        $this->definition = $definition;
        $this->defaultCriteria = [];
        $this->userCriteria = [];
        $this->predefinedCriteria = [];
    }

    public function getDefinition(): FilterDefinition
    {
        return $this->definition;
    }

    public function setDefaultCriteria(array $defaultCriteria): void
    {
        $this->defaultCriteria = $defaultCriteria;
    }

    public function setUserCriteria(array $userCriteria): void
    {
        $this->userCriteria = $userCriteria;
    }

    public function setPredefinedCriteria(array $predefinedCriteria)
    {
        $this->predefinedCriteria = $predefinedCriteria;
    }

    public function getPredefinedCriteria(): array
    {
        return $this->predefinedCriteria;
    }

    public function getAllCriteria(): array
    {
        return array_merge(
            $this->defaultCriteria,
            $this->userCriteria,
            $this->predefinedCriteria,
        );
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    public function getSortOrder(): array
    {
        return $this->sortOrder;
    }

    public function setSortOrder(array $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }
}
