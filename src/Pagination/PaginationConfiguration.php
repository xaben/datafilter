<?php

declare(strict_types=1);

namespace Xaben\DataFilter\Pagination;

class PaginationConfiguration
{
    public const DEFAULT_RESULT_COUNT = 10;

    public const MAX_RESULT_COUNT = 150;

    private int $defaultResultCount;

    private int $maxResultCount;

    public function __construct(
        int $defaultResultCount = self::DEFAULT_RESULT_COUNT,
        int $maxResultCount = self::MAX_RESULT_COUNT
    ) {
        $this->defaultResultCount = $defaultResultCount;
        $this->maxResultCount = $maxResultCount;
    }

    public function getByPage(int $page, int $limit): array
    {
        $limit = $this->validateLimit($limit);

        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;

        return [$offset, $limit];
    }

    public function getByOffset(int $offset, int $limit): array
    {
        $limit = $this->validateLimit($limit);

        if ($offset < 0) {
            $offset = 0;
        }

        return [$offset, $limit];
    }

    private function validateLimit(int $limit): int
    {
        if ($limit <= 0) {
            $limit = $this->defaultResultCount;
        }

        if ($limit > $this->maxResultCount) {
            $limit = $this->maxResultCount;
        }

        return $limit;
    }
}
