<?php

declare(strict_types=1);

namespace Xaben\DataFilter\DataType;

class CallbackDataType implements DataTypeInterface
{
    /** @var callable */
    private $prepareFunction;

    /**
     * @param callable $prepareFunction
     */
    public function __construct(callable $prepareFunction)
    {
        $this->prepareFunction = $prepareFunction;
    }

    public function prepare(mixed $value): mixed
    {
        return ($this->prepareFunction)($value);
    }
}
