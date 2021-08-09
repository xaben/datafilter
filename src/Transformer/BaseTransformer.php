<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Transformer;

abstract class BaseTransformer
{
    public function transformCollection(iterable $data): array
    {
        $result = [];
        foreach ($data as $item) {
            $result[] = $this->transform($item);
        }

        return $result;
    }

    abstract public function transform(mixed $data): array;
}
