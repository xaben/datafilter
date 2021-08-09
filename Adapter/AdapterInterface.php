<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Adapter;

use Xaben\DataFilter\Definition\FilterDefinitionInterface;
use Xaben\DataFilter\Filter\CollectionFilter;
use Symfony\Component\HttpFoundation\Request;

interface AdapterInterface
{
    /**
     * Builds a Collection filter based on definition and Request
     *
     * @param string|FilterDefinitionInterface $definition
     * @param Request $request
     * @param CollectionFilter|null $collectionFilter
     *
     * @throws \Exception
     * @return array
     *
     */
    public function process(
        string | FilterDefinitionInterface $definition,
        Request $request,
        CollectionFilter $collectionFilter = null
    );
}
