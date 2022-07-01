<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterLength;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\ValueObject\StringValueObject;

final class EmployeeIdentificationNumber extends StringValueObject
{
    public const COLUMN = 'identification_number';

    private const MAX_LENGTH = 20;

    /**
     * @throws EmptyValue
     * @throws InvalidEmployeeIdentificationNumber
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
     * @throws InvalidEmployeeIdentificationNumber
     */
    private function validateParameterCase(): void
    {
        preg_match('/^[a-zA-Z\d-]+$/', $this->value(), $match);
        if (!$match) {
            throw new InvalidEmployeeIdentificationNumber(self::COLUMN);
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
