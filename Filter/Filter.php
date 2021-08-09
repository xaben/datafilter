<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

use Xaben\DataFilter\DataType\DataTypeInterface;

interface Filter
{
    /**
     * @param string $name - name of the filter
     * @param string|DataTypeInterface $dataType - class name or instance of DataTypeInterface
     * @param string|null $columnName -
     * @param array $options
     * @param mixed $defaultValue - the value for default or predefined filters
     */
    public function __construct(
        string $name,
        string | DataTypeInterface $dataType,
        string $columnName = null,
        array $options = [],
        mixed $defaultValue = null
    );

    public function getName(): string|int;

    public function getFilter(mixed $value): array;

    public function getDefaultFilter(): array;
}
