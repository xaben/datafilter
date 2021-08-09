<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

use Exception;
use Xaben\DataFilter\DataType\DataTypeInterface;

abstract class BaseFilter implements Filter
{
    protected string|int $name;

    protected DataTypeInterface $dataType;

    protected string $columnName;

    protected array $options;

    private mixed $defaultValue;

    public function __construct(
        string | int $name,
        string | DataTypeInterface $dataType,
        string $columnName,
        array $options = [],
        mixed $defaultValue = null
    ) {
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

            $dataType = new $dataType();
        }

        if (!$dataType instanceof DataTypeInterface) {
            throw new Exception('Unknown Data Type');
        }

        return $dataType;
    }

    public function getName(): string|int
    {
        return $this->name;
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
