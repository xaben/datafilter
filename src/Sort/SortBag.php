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

    public function __construct(array $sortDefinitions = [])
    {
        foreach ($sortDefinitions as $sortDefinition) {
            if (!$sortDefinition instanceof SortDefinition) {
                throw new InvalidSortDefinitionException('Provided sort definition is not a SortDefinition');
            }
        }

        $this->sortDefinitions = $sortDefinitions;
        $this->initNameIndex();
    }

    public function getSortDefinition(string|int $name): ?SortDefinition
    {
        if ($this->sortDefinitionsByName === null) {
            $this->initNameIndex();
        }

        return $this->sortDefinitionsByName[$name] ?? null;
    }

    private function initNameIndex(): void
    {
        $this->sortDefinitionsByName = [];

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

    /**
     * @return SortDefinition[]
     */
    public function getAllDefinitions(): array
    {
        return $this->sortDefinitions;
    }
}
