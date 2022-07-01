<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Shared\ValueObject\UuidValueObject;

final class EmployeeId extends UuidValueObject
{
    public const COLUMN = 'id';
}
