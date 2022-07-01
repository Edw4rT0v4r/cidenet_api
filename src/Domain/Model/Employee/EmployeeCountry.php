<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeCountry;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\ValueObject\StringValueObject;

final class EmployeeCountry extends StringValueObject
{
    public const COLUMN = 'country';

    public const COUNTRY_COLOMBIA = 'COP';

    public const COUNTRY_ESTADOS_UNIDOS = 'USA';

    public static array $countries = [self::COUNTRY_COLOMBIA, self::COUNTRY_ESTADOS_UNIDOS];

    /**
     * @throws EmptyValue
     * @throws InvalidEmployeeCountry
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->validateEmpty();
        $this->validateCountry();
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
     * @throws InvalidEmployeeCountry
     */
    private function validateCountry(): void
    {
        if (!in_array($this->value(), self::$countries, true)) {
            throw new InvalidEmployeeCountry($this);
        }
    }
}
