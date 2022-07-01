<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\ValueObject\StringValueObject;

final class EmployeeEmail extends StringValueObject
{
    public const COLUMN = 'email';

    /**
     * @throws EmptyValue
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->validateEmpty();
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
}
