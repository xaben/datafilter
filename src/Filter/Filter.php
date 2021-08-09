<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Filter;

interface Filter
{
    public function getName(): string|int;

    public function getFilter(mixed $value): array;

    public function getDefaultFilter(): array;
}
