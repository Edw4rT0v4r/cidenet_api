<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeStatus;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\ValueObject\StringValueObject;

final class EmployeeStatus extends StringValueObject
{
    public const COLUMN = 'status';

    public const STATUS_ACTIVE = 'Active';

    public const STATUS_INACTIVE = 'Inactive';

    public static array $status = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    /**
     * @throws EmptyValue
     * @throws InvalidEmployeeStatus
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->validateEmpty();
        $this->validateStatus();
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
     * @throws InvalidEmployeeStatus
     */
    private function validateStatus(): void
    {
        if (!in_array($this->value(), self::$status, true)) {
            throw new InvalidEmployeeStatus($this);
        }
    }
}
