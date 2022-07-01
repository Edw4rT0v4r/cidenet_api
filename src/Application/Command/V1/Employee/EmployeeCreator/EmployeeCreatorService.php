<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeCreator;

use Cidenet\Api\Domain\Model\Employee\Employee;
use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeEmail;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeRepositoryInterface;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeStatus;
use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;

class EmployeeCreatorService
{
    private EmployeeRepositoryInterface $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \Exception
     */
    public function execute(
        EmployeeId $id,
        EmployeeFirstName $firstName,
        EmployeeOtherName $otherName,
        EmployeeFirstSurname $firstSurname,
        EmployeeSecondSurname $secondSurname,
        EmployeeEmail $email,
        EmployeeCountry $country,
        EmployeeIdType $idType,
        EmployeeIdentificationNumber $identificationNumber,
        EmployeeAdmissionDate $dateAdmission,
        EmployeeArea $area,
        EmployeeStatus $status
    ): EmployeeId {
        return $this->repository->create(Employee::create(
            $id,
            $firstName,
            $otherName,
            $firstSurname,
            $secondSurname,
            $email,
            $country,
            $idType,
            $identificationNumber,
            $dateAdmission,
            $area,
            $status,
            DateValueObject::now()
        ));
    }
}
