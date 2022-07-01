<?php

declare(strict_types=1);

namespace App\Models;

use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeEmail;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeStatus;
use Cidenet\Api\Infrastructure\Persistence\Type\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Uuid;
    use HasFactory;

    protected $keyType = 'uuid';

    protected $fillable = [
        EmployeeFirstName::COLUMN,
        EmployeeOtherName::COLUMN,
        EmployeeFirstSurname::COLUMN,
        EmployeeSecondSurname::COLUMN,
        EmployeeEmail::COLUMN,
        EmployeeCountry::COLUMN,
        EmployeeIdType::COLUMN,
        EmployeeIdentificationNumber::COLUMN,
        EmployeeAdmissionDate::COLUMN,
        EmployeeArea::COLUMN,
        EmployeeStatus::COLUMN,
    ];
}
