<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

use Xaben\DataFilter\Exception\InvalidFilterException;

class FilterBag
{
    /** @var FilterInterface[] */
    private array $filters;

    /** @var FilterInterface[] */
    private array $filtersByName;

    /** @var FilterInterface[] */
    private array $filtersByIndex;

    public function __construct(array $filters = [])
    {
        $this->filters = $this->validateFilters($filters);
        $this->filtersByIndex = [];
        $this->filtersByName = [];
    }

    private function validateFilters(array $filters): array
    {
        foreach ($filters as $filter) {
            if (!$filter instanceof FilterInterface) {
                throw new InvalidFilterException('Provided filter does not implement FilterInterface');
            }
        }

        return $filters;
    }

    public function getAllFilters(): array
    {
        $criteria = [];
        foreach ($this->filters as $filter) {
            $criteria = array_merge($criteria, $filter->getDefaultFilter());
        }

        return $criteria;
    }

    public function getFilterByName(string $name): ?FilterInterface
    {
        if ($this->filtersByName === null) {
            $this->initNameIndex();
        }

        return $this->filtersByName[$name] ?? null;
    }

    private function initNameIndex(): void
    {
        if ($this->filtersByName === null) {
            $this->filtersByName = [];
        }

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

    public function getFilterByIndex(int $index): ?FilterInterface
    {
        if ($this->filtersByIndex === null) {
            $this->initNumericIndex();
        }

        return $this->filtersByIndex[$index] ?? null;
    }

    private function initNumericIndex(): void
    {
        foreach ($this->filters as $filter) {
            if ($filter->getIndex() === null) {
                throw new InvalidFilterException('Filter index is not defined');
            }

            if (isset($this->filtersByIndex[$filter->getIndex()])) {
                throw new InvalidFilterException('Filter with same index defined twice');
            }

            $this->filtersByIndex[$filter->getIndex()] = $filter;
        }
    }
}
