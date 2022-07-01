<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;

final class EmployeeAdmissionDate extends DateValueObject
{
    public const COLUMN = 'admission_date';
}
