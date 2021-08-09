<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

class FloatDataType implements DataTypeInterface
{
    public function prepare(mixed $value): float
    {
        return (float) $value;
    }
}
