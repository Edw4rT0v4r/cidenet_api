<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterCase;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterLength;
use Cidenet\Api\Domain\Shared\ValueObject\NullableStringValueObject;

final class EmployeeOtherName extends NullableStringValueObject
{
    public const COLUMN = 'other_name';

    private const MAX_LENGTH = 50;

    /**
     * @throws InvalidParameterCase
     * @throws InvalidParameterLength
     */
    public function __construct(?string $value)
    {
        parent::__construct($value);
        $this->validateLength();
        $this->validateParameterCase();
    }

    /**
     * @throws InvalidParameterCase
     */
    private function validateParameterCase(): void
    {
        if ($this->value()) {
            preg_match('/^[A-Z\s]+$/', $this->value(), $match);
            if (!$match) {
                throw new InvalidParameterCase(self::COLUMN);
            }
        }
    }

    /**
     * @throws InvalidParameterLength
     */
    private function validateLength(): void
    {
        if ($this->value() && strlen($this->value()) > self::MAX_LENGTH) {
            throw new InvalidParameterLength(self::COLUMN, self::MAX_LENGTH);
        }
    }
}
