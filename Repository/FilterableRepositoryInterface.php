<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Repository;

use Xaben\DataFilter\Filter\CollectionFilter;
use Xaben\DataFilter\Filter\Result;

interface FilterableRepositoryInterface
{
    public function findFiltered(CollectionFilter $filter): Result;
}
