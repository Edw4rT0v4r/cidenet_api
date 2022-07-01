<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeUpdater;

use Cidenet\Api\Domain\Model\Employee\Employee;
use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeEmail;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeRepositoryInterface;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;

class EmployeeUpdaterService
{
    private EmployeeRepositoryInterface $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(
        Employee $employee,
        EmployeeFirstName $firstName,
        EmployeeOtherName $otherName,
        EmployeeFirstSurname $firstSurname,
        EmployeeSecondSurname $secondSurname,
        EmployeeEmail $email,
        EmployeeCountry $country,
        EmployeeIdType $idType,
        EmployeeIdentificationNumber $identificationNumber,
        EmployeeAdmissionDate $dateAdmission,
        EmployeeArea $area
    ): void {
        $this->repository->update($employee->update(
            $firstName,
            $otherName,
            $firstSurname,
            $secondSurname,
            $email,
            $country,
            $idType,
            $identificationNumber,
            $dateAdmission,
            $area
        ));
    }
}
