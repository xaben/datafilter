<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

class IntegerDataType implements DataTypeInterface
{
    public function prepare(mixed $value): int
    {
        return (int) $value;
    }
}
