<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\ValueObject;

abstract class NullableStringValueObject
{
    protected ?string $value;

    public function __construct(?string $value)
    {
        $this->value = $value ? trim($value) : null;
    }

    public function __toString()
    {
        return $this->value() ?? '';
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function upper(): string
    {
        return strtoupper($this->__toString());
    }

    public function lower(): string
    {
        return strtolower($this->__toString());
    }

    public function equalsTo(?string $value): bool
    {
        $value = $value ? trim($value) : $value;

        return $this->value() === $value;
    }
}
