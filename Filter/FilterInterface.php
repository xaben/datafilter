<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

use Xaben\DataFilter\DataType\DataTypeInterface;

interface FilterInterface
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

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int|null
     */
    public function getIndex(): ?int;

    /**
     * @param mixed $value
     * @return mixed
     */
    public function getFilter($value): array;

    /**
     * @return array
     */
    public function getDefaultFilter(): array;
}
