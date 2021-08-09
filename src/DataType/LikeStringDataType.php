<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

class LikeStringDataType implements DataTypeInterface
{
    public const STARTS_WITH = 1;

    public const ENDS_WITH = 2;

    public const CONTAINS = 3;

    /**
     * @var int
     */
    private $mode;

    /**
     * @param int $mode
     */
    public function __construct($mode = self::STARTS_WITH)
    {
        $this->mode = $mode;
    }

    public function prepare(mixed $value): string
    {
        return $this->appendMode(
            $this->escape(
                (string) $value
            )
        );
    }

    /**
     * Append wild card characters depending on the filter mode
     *
     * @param string $value
     * @return string
     */
    private function appendMode(string $value): string
    {
        switch ($this->mode) {
            case self::CONTAINS:
                $pattern = '%%%s%%';

                break;
            case self::ENDS_WITH:
                $pattern = '%%%s';

                break;
            case self::STARTS_WITH:
            default:
                $pattern = '%s%%';
        }

        return sprintf($pattern, $value);
    }

    /**
     * Doctrine does not escape "%" and "_" characters for LIKE queries, so we need to escape them
     *
     * @param string $value
     * @return string
     */
    private function escape(string $value): string
    {
        $escapeChar = '!';
        $escape = [
            '\\' . $escapeChar, // Must escape the escape-character for regex
            '\%',
            '\_',
        ];
        $pattern = sprintf('/([%s])/', implode('', $escape));

        return preg_replace($pattern, $escapeChar . '$0', $value);
    }
}
