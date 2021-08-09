<?php

namespace Xaben\DataFilter\Sort;

use Xaben\DataFilter\Exception\InvalidValueException;

class SortDefinition
{
    public const SORT_ASC = 'asc';

    public const SORT_DESC = 'desc';

    private string|int $name;

    private string $columnName;

    private ?string $defaultSortOrder;

    public function __construct(
        string|int $name,
        string $columnName,
        ?string $defaultSortOrder = null
    ) {
        if ($defaultSortOrder !== null) {
            $this->validateSortOrder($defaultSortOrder);
        }

        $this->name = $name;
        $this->columnName = $columnName;
        $this->defaultSortOrder = $defaultSortOrder;
    }

    protected function validateSortOrder(string $sortOrder): void
    {
        if (!in_array($sortOrder, [self::SORT_ASC, self::SORT_DESC])) {
            throw new InvalidValueException('Unsupported sort direction.');
        }
    }

    public function getSortOrder(string $sortOrder): array
    {
        $this->validateSortOrder($sortOrder);

        return [
            $this->columnName => $sortOrder,
        ];
    }

    public function getDefaultSortOrder(): array
    {
        if ($this->defaultSortOrder === null) {
            return [];
        }

        return [
            $this->columnName => $this->defaultSortOrder,
        ];
    }

    public function getName(): string|int
    {
        return $this->name;
    }
}
