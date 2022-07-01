<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\ValueObject;

use Cidenet\Api\Domain\Shared\Exception\InvalidArgument;
use Illuminate\Support\Str;

abstract class UuidValueObject
{
    protected string $value;

    /**
     * @throws InvalidArgument
     */
    public function __construct(string $value)
    {
        $this->value = trim($value);
        $this->ensureIsValidUuid();
    }

    public function __toString()
    {
        return $this->value();
    }

    /**
     * @throws InvalidArgument
     */
    public static function random(): self
    {
        return new static(Str::uuid()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equalsTo(self $value): bool
    {
        return $this->value() === $value->value();
    }

    /**
     * @throws InvalidArgument
     */
    private function ensureIsValidUuid(): void
    {
        if (!Str::isUuid($this->value())) {
            throw new InvalidArgument(static::COLUMN);
        }
    }
}
