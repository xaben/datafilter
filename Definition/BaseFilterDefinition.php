<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Definition;

use Xaben\DataFilter\Filter\FilterBag;
use Xaben\DataFilter\Pagination\PaginationConfiguration;
use Xaben\DataFilter\Repository\FilterableRepositoryInterface;
use Xaben\DataFilter\Sort\SortBag;
use Xaben\DataFilter\Transformer\Transformer;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseFilterDefinition implements FilterDefinitionInterface
{
    private FilterableRepositoryInterface $repository;

    private Transformer $transformer;

    public function __construct(
        FilterableRepositoryInterface $repository,
        Transformer $transformer
    ) {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function getPaginationConfiguration(): ?PaginationConfiguration
    {
        return new PaginationConfiguration();
    }

    public function getSortConfiguration(): SortBag
    {
        return new SortBag();
    }

    public function getFilterConfiguration(): FilterBag
    {
        return new FilterBag();
    }

    public function getDefaultFilterConfiguration(Request $request): FilterBag
    {
        return new FilterBag();
    }

    public function getPredefinedFilterConfiguration(Request $request): FilterBag
    {
        return new FilterBag();
    }

    public function getRepositoryService(): FilterableRepositoryInterface
    {
        return $this->repository;
    }

    public function getTransformerService(): Transformer
    {
        return $this->transformer;
    }
}
