<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Adapter;

use Xaben\DataFilter\Definition\FilterDefinitionInterface;
use Xaben\DataFilter\Filter\CollectionFilter;
use Xaben\DataFilter\Formatter\Formatter;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseAdapter
{
    protected Formatter $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function process(
        string | FilterDefinitionInterface $definition,
        Request $request,
        CollectionFilter $collectionFilter = null
    ): array {
        $definition = $this->initializeDefinition($definition);
        $filter = $this->getFilter($definition, $request, $collectionFilter);
        $data = $definition->getRepositoryService()->findFiltered($filter);

        return $this->formatter->format($data, $definition->getTransformerService());
    }

    private function initializeDefinition(string | FilterDefinitionInterface $definition): FilterDefinitionInterface
    {
        if ($definition instanceof FilterDefinitionInterface) {
            return $definition;
        }

        if (!in_array(FilterDefinitionInterface::class, class_implements($definition))) {
            throw new \Exception(
                sprintf('%s does not implement FilterDefinitionInterface interface.', $definition)
            );
        }

        return new $definition();
    }

    public function getFilter(
        FilterDefinitionInterface $definition,
        Request $request,
        CollectionFilter $collectionFilter = null
    ): CollectionFilter {
        if (is_null($collectionFilter)) {
            $collectionFilter = new CollectionFilter($definition);
        }

        $this->processPagination($definition, $request, $collectionFilter);
        $this->processSortable($definition, $request, $collectionFilter);
        $this->processFilters($definition, $request, $collectionFilter);

        return $collectionFilter;
    }

    /**
     * Prepare query params for pagination
     *
     * @param FilterDefinitionInterface $definition
     * @param Request $request
     * @param CollectionFilter $collectionFilter
     *
     * @return mixed
     */
    abstract protected function processPagination(
        FilterDefinitionInterface $definition,
        Request $request,
        CollectionFilter $collectionFilter
    ): void;

    /**
     * Prepare query params for sortable
     *
     * @param FilterDefinitionInterface $definition
     * @param Request $request
     * @param CollectionFilter $collectionFilter
     *
     * @return mixed
     */
    abstract protected function processSortable(
        FilterDefinitionInterface $definition,
        Request $request,
        CollectionFilter $collectionFilter
    ): void;

    /**
     * Prepare query params for filters
     *
     * @param FilterDefinitionInterface $definition
     * @param Request $request
     * @param CollectionFilter $collectionFilter
     *
     * @return mixed
     */
    abstract protected function processFilters(
        FilterDefinitionInterface $definition,
        Request $request,
        CollectionFilter $collectionFilter
    ): void;
}
