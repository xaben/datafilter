<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

class BooleanDataType implements DataTypeInterface
{
    public function prepare(mixed $value): bool
    {
        return (bool) filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
