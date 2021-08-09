<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Formatter;

use Xaben\DataFilter\Filter\Result;
use Xaben\DataFilter\Transformer\Transformer;

interface Formatter
{
    public function format(Result $result, Transformer $transformer): array;
}
