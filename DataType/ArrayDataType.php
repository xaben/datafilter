<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

class ArrayDataType implements DataTypeInterface
{
    public function prepare(mixed $value): array
    {
        return (array) $value;
    }
}
