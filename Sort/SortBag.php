<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Sort;

use Xaben\DataFilter\Exception\InvalidSortDefinitionException;

class SortBag
{
    /** @var SortDefinition[] */
    private array $sortDefinitions;

    /** @var SortDefinition[] */
    private ?array $sortDefinitionsByName;

    /** @var SortDefinition[] */
    private ?array $sortDefinitionsByIndex;

    public function __construct(array $sortDefinitions = [])
    {
        foreach ($sortDefinitions as $sortDefinition) {
            if (!$sortDefinition instanceof SortDefinition) {
                throw new InvalidSortDefinitionException('Provided sort definition is not a SortDefinition');
            }
        }

        $this->sortDefinitions = $sortDefinitions;
        $this->sortDefinitionsByName = null;
        $this->sortDefinitionsByIndex = null;
    }

    /**
     * @param string $name
     * @return null|SortDefinition
     */
    public function getSortDefinitionByName(string $name): ?SortDefinition
    {
        if ($this->sortDefinitionsByName === null) {
            $this->initNameIndex();
        }

        return $this->sortDefinitionsByName[$name] ?? null;
    }

    private function initNameIndex(): void
    {
        if ($this->sortDefinitionsByName === null) {
            $this->sortDefinitionsByName = [];
        }
        foreach ($this->sortDefinitions as $sortDefinition) {
            if (array_key_exists(
                $sortDefinition->getName(),
                $this->sortDefinitionsByName
            )) {
                throw new InvalidSortDefinitionException('SortDefinition with same name defined twice');
            }

            $this->sortDefinitionsByName[$sortDefinition->getName()] = $sortDefinition;
        }
    }

    public function getSortDefinitionByIndex(int $index): ?SortDefinition
    {
        if ($this->sortDefinitionsByIndex === null) {
            $this->initNumericIndex();
        }

        return $this->sortDefinitionsByIndex[$index] ?? null;
    }

    private function initNumericIndex(): void
    {
        foreach ($this->sortDefinitions as $sortDefinition) {
            if (!is_int($sortDefinition->getIndex())) {
                throw new InvalidSortDefinitionException('SortDefinition does not have numeric index');
            }

            if (isset($this->sortDefinitionsByIndex[$sortDefinition->getIndex()])) {
                throw new InvalidSortDefinitionException('SortDefinition with same index defined twice');
            }

            $this->sortDefinitionsByIndex[$sortDefinition->getIndex()] = $sortDefinition;
        }
    }

    /**
     * @return SortDefinition[]
     */
    public function getAllDefinitions(): array
    {
        return $this->sortDefinitions;
    }
}
