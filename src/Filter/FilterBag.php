<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

use Xaben\DataFilter\Exception\InvalidFilterException;

class FilterBag
{
    /** @var Filter[] */
    private array $filters;

    /** @var Filter[] */
    private array $filtersByName;

    public function __construct(array $filters = [])
    {
        $this->filters = $this->validateFilters($filters);
        $this->indexByName();
    }

    private function validateFilters(array $filters): array
    {
        foreach ($filters as $filter) {
            if (!$filter instanceof Filter) {
                throw new InvalidFilterException('Provided filter does not implement FilterInterface');
            }
        }

        return $filters;
    }

    public function getCriteria(): array
    {
        $criteria = [];
        foreach ($this->filters as $filter) {
            $criteria = array_merge($criteria, $filter->getDefaultFilter());
        }

        return $criteria;
    }

    public function getFilter(string|int $name): ?Filter
    {
        return $this->filtersByName[$name] ?? null;
    }

    private function indexByName(): void
    {
        $this->filtersByName = [];

        foreach ($this->filters as $filter) {
            if (array_key_exists(
                $filter->getName(),
                $this->filtersByName
            )) {
                throw new InvalidFilterException('Filter with same name defined twice');
            }

            $this->filtersByName[$filter->getName()] = $filter;
        }
    }
}
