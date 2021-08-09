<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Formatter;

use Xaben\DataFilter\Filter\Result;
use Xaben\DataFilter\Transformer\Transformer;

class RawFormatter implements Formatter
{
    public function format(Result $result, Transformer $transformer): array
    {
        return [
            'recordsTotal' => $result->getTotalResults(),
            'recordsFiltered' => $result->getFilteredResults(),
            'hasMore' => $result->hasMore(),
            'data' => $result->getData(),
        ];
    }
}
