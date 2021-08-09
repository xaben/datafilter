<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Adapter;

use Xaben\DataFilter\Definition\FilterDefinition;
use Xaben\DataFilter\Filter\CollectionFilter;

interface Adapter
{
    public function process(
        string | FilterDefinition $definition,
        array $requestParameters,
        CollectionFilter $collectionFilter = null
    ): array;
}
