<?php

namespace Xaben\DataFilter\Pagination;

class PaginationConfiguration
{
    public const DEFAULT_RESULT_COUNT = 10;

    public const MAX_RESULT_COUNT = 150;

    /** @var int */
    private $defaultResultCount;

    /** @var int */
    private $maxResultCount;

    /**
     * @param int $defaultResultCount
     * @param int $maxResultCount
     */
    public function __construct(
        int $defaultResultCount = self::DEFAULT_RESULT_COUNT,
        int $maxResultCount = self::MAX_RESULT_COUNT
    ) {
        $this->defaultResultCount = $defaultResultCount;
        $this->maxResultCount = $maxResultCount;
    }

    /**
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getByPage(int $page, int $limit)
    {
        $limit = $this->validateLimit($limit);

        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;

        return [$offset, $limit];
    }

    /**
     * @param int $limit
     * @return int
     */
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

    /**
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getByOffset(int $offset, int $limit)
    {
        $limit = $this->validateLimit($limit);

        if ($offset < 0) {
            $offset = 0;
        }

        return [$offset, $limit];
    }
}
