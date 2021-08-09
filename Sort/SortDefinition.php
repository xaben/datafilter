<?php

namespace Xaben\DataFilter\Sort;

use Xaben\DataFilter\Exception\InvalidValueException;

class SortDefinition
{
    public const SORT_ASC = 'asc';

    public const SORT_DESC = 'desc';

    private string $name;

    private string $columnName;

    private ?int $index;

    private ?string $defaultSortOrder;

    public function __construct(
        string $name,
        ?string $columnName = null,
        ?int $index = null,
        ?string $defaultSortOrder = null
    ) {
        if ($columnName === null) {
            $columnName = $name;
        }

        if ($defaultSortOrder !== null) {
            $this->validateSortOrder($defaultSortOrder);
        }

        $this->name = $name;
        $this->columnName = $columnName;
        $this->index = $index;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getIndex(): ?int
    {
        return $this->index;
    }
}
