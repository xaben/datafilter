<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

class Result
{
    protected CollectionFilter $filter;

    protected int $totalResults;

    protected int $filteredResults;

    protected iterable $data;

    public function __construct(CollectionFilter $filter, int $totalResults, int $filteredResults, iterable $data)
    {
        $this->filter = $filter;
        $this->totalResults = $totalResults;
        $this->filteredResults = $filteredResults;
        $this->data = $data;
    }

    public function getFilter(): CollectionFilter
    {
        return $this->filter;
    }

    public function getTotalResults(): int
    {
        return $this->totalResults;
    }

    public function getData(): iterable
    {
        return $this->data;
    }

    public function hasMore(): bool
    {
        return $this->filter->getOffset() + $this->filter->getLimit() < $this->getFilteredResults();
    }

    public function getFilteredResults(): int
    {
        return $this->filteredResults;
    }
}
