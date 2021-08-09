<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Adapter;

use Xaben\DataFilter\Definition\FilterDefinition;
use Xaben\DataFilter\Filter\CollectionFilter;
use Xaben\DataFilter\Formatter\Formatter;

abstract class BaseAdapter
{
    protected Formatter $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function process(
        string | FilterDefinition $definition,
        array $requestParameters,
        CollectionFilter $collectionFilter = null
    ): array {
        $definition = $this->initializeDefinition($definition);
        $filter = $this->getFilter($definition, $requestParameters, $collectionFilter);
        $data = $definition->getRepositoryService()->findFiltered($filter);

        return $this->formatter->format($data, $definition->getTransformerService());
    }

    private function initializeDefinition(string | FilterDefinition $definition): FilterDefinition
    {
        if (is_string($definition)) {
            if (!class_exists($definition)) {
                throw new \Exception('Unknown Class');
            }

            $definition = new $definition();
        }

        if (!$definition instanceof FilterDefinition) {
            throw new \Exception(
                sprintf('%s does not implement FilterDefinitionInterface interface.', get_class($definition))
            );
        }

        return $definition;
    }

    public function getFilter(
        FilterDefinition $definition,
        array $requestParameters,
        CollectionFilter $collectionFilter = null
    ): CollectionFilter {
        if (is_null($collectionFilter)) {
            $collectionFilter = new CollectionFilter($definition);
        }

        $this->processPagination($definition, $requestParameters, $collectionFilter);
        $this->processSortable($definition, $requestParameters, $collectionFilter);
        $this->processFilters($definition, $requestParameters, $collectionFilter);

        return $collectionFilter;
    }

    abstract protected function processPagination(
        FilterDefinition $definition,
        array $requestParameters,
        CollectionFilter $collectionFilter
    ): void;

    abstract protected function processSortable(
        FilterDefinition $definition,
        array $requestParameters,
        CollectionFilter $collectionFilter
    ): void;

    abstract protected function processFilters(
        FilterDefinition $definition,
        array $requestParameters,
        CollectionFilter $collectionFilter
    ): void;
}
