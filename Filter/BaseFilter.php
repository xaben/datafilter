<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

use Exception;
use Xaben\DataFilter\DataType\DataTypeInterface;
use Xaben\DataFilter\Exception\InvalidFilterException;

abstract class BaseFilter implements Filter
{
    protected string $name;

    protected DataTypeInterface $dataType;

    protected string $columnName;

    protected array $options;

    private mixed $defaultValue;

    public function __construct(
        string $name,
        string | DataTypeInterface $dataType,
        string $columnName = null,
        array $options = [],
        mixed $defaultValue = null
    ) {
        if ($columnName === null) {
            $columnName = $name;
        }

        $this->name = $name;
        $this->dataType = $this->prepareDataType($dataType);
        $this->columnName = $columnName;
        $this->options = $options;
        $this->defaultValue = $defaultValue;
    }

    private function prepareDataType(string | DataTypeInterface $dataType): DataTypeInterface
    {
        if (is_string($dataType)) {
            if (!class_exists($dataType)) {
                throw new Exception('Unknown Data Type');
            }

            return new $dataType();
        }

        return $dataType;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIndex(): ?int
    {
        if (!array_key_exists('index', $this->options) || $this->options['index'] === null) {
            return null;
        }

        if (!is_int($this->options['index'])) {
            throw new InvalidFilterException('Filter index is not numeric');
        }

        return $this->options['index'];
    }

    public function getDefaultFilter(): array
    {
        return $this->getFilter($this->defaultValue);
    }

    /**
     * Checks if value is not null or empty string.
     * 0, false '0' are considered valid values.
     */
    protected function isEmpty(mixed $value): bool
    {
        if (is_array($value)) {
            $isEmpty = true;
            foreach ($value as $item) {
                $isEmpty = $isEmpty && $this->isEmpty($item);
            }

            return $isEmpty;
        }

        return is_null($value) || $value === '';
    }
}
