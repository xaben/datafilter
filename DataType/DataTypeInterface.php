<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

interface DataTypeInterface
{
    /**
     * Prepare a raw value to an expected one
     */
    public function prepare(mixed $value): mixed;
}
