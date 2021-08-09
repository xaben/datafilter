<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

class StringDataType implements DataTypeInterface
{
    public function prepare(mixed $value): string
    {
        return (string) $value;
    }
}
