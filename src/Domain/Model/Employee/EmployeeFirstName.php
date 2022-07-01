<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterCase;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterLength;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\ValueObject\StringValueObject;

final class EmployeeFirstName extends StringValueObject
{
    public const COLUMN = 'first_name';

    private const MAX_LENGTH = 20;

    /**
     * @throws EmptyValue
     * @throws InvalidParameterCase
     * @throws InvalidParameterLength
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->validateEmpty();
        $this->validateLength();
        $this->validateParameterCase();
    }

    /**
     * @throws EmptyValue
     */
    private function validateEmpty(): void
    {
        if (!trim($this->value())) {
            throw new EmptyValue(self::COLUMN);
        }
    }

    /**
     * @throws InvalidParameterCase
     */
    private function validateParameterCase(): void
    {
        preg_match('/^[A-Z\s]+$/', $this->value(), $match);
        if (!$match) {
            throw new InvalidParameterCase(self::COLUMN);
        }
    }

    /**
     * @throws InvalidParameterLength
     */
    private function validateLength(): void
    {
        if (strlen($this->value()) > self::MAX_LENGTH) {
            throw new InvalidParameterLength(self::COLUMN, self::MAX_LENGTH);
        }
    }
}
