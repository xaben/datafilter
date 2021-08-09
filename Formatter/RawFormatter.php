<?php

namespace Xaben\DataFilter\Formatter;

use Xaben\DataFilter\Filter\Result;
use Xaben\DataFilter\Transformer\Transformer;

class RawFormatter implements Formatter
{
    /**
     * @covers \App\Filter\Formatter\RawFormatter::format()
     *
     * @param Result $result
     * @param Transformer $transformer
     * @return array
     */
    public function format(Result $result, Transformer $transformer)
    {
        return [
            'recordsTotal' => $result->getTotalResults(),
            'recordsFiltered' => $result->getFilteredResults(),
            'hasMore' => $result->hasMore(),
            'data' => $result->getData(),
        ];
    }
}
