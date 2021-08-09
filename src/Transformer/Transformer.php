<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Transformer;

interface Transformer
{
    public function transformCollection(iterable $data): array;

    public function transform(mixed $data): array;
}
