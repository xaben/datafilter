<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

use DateTime;

class DateDataType implements DataTypeInterface
{
    public function prepare(mixed $value): DateTime
    {
        return DateTime::createFromFormat('!m/d/Y', $value);
    }
}
