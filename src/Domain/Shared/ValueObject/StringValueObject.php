<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\ValueObject;

abstract class StringValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = trim($value);
    }

    public function __toString()
    {
        return $this->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function upper(): string
    {
        return strtoupper($this->value());
    }

    public function lower(): string
    {
        return strtolower($this->value());
    }

    public function equalsTo(string $value): bool
    {
        return $this->value() === trim($value);
    }
}
