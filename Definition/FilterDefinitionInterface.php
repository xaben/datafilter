<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Definition;

use Xaben\DataFilter\Filter\FilterBag;
use Xaben\DataFilter\Pagination\PaginationConfiguration;
use Xaben\DataFilter\Repository\FilterableRepositoryInterface;
use Xaben\DataFilter\Sort\SortBag;
use Xaben\DataFilter\Transformer\Transformer;
use Symfony\Component\HttpFoundation\Request;

interface FilterDefinitionInterface
{
    public function getPaginationConfiguration(): ?PaginationConfiguration;

    public function getFilterConfiguration(): FilterBag;

    public function getSortConfiguration(): SortBag;

    public function getDefaultFilterConfiguration(Request $request): FilterBag;

    public function getPredefinedFilterConfiguration(Request $request): FilterBag;

    public function getRepositoryService(): FilterableRepositoryInterface;

    public function getTransformerService(): Transformer;
}
