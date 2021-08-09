<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

use Xaben\DataFilter\Definition\FilterDefinitionInterface;

class CollectionFilter
{
    protected FilterDefinitionInterface $definition;

    protected array $criteria;

    protected array $predefinedCriteria;

    protected array $sortOrder;

    protected int $offset;

    protected int $limit;

    public function __construct(FilterDefinitionInterface $definition)
    {
        $this->definition = $definition;
        $this->criteria = [];
        $this->predefinedCriteria = [];
    }

    public function getDefinition(): FilterDefinitionInterface
    {
        return $this->definition;
    }

    public function getCriteria(): array
    {
        return $this->criteria;
    }

    public function setCriteria(array $criteria): void
    {
        $this->criteria = $criteria;
    }

    public function getPredefinedCriteria(): array
    {
        return $this->predefinedCriteria;
    }

    public function setPredefinedCriteria(array $predefinedCriteria)
    {
        $this->predefinedCriteria = $predefinedCriteria;
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
