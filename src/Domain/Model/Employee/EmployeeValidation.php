<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Model\Employee\Exception\EmployeeAlreadyExists;
use Cidenet\Api\Domain\Model\Employee\Exception\EmployeeNotFound;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeDateAdmission;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;
use DateInterval;
use Exception;

class EmployeeValidation
{
    private EmployeeRepositoryInterface $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws EmployeeNotFound
     */
    public function checkEmployeeExist(EmployeeId $id): Employee
    {
        $employee = $this->repository->byId($id);

        if (!$employee) {
            throw new EmployeeNotFound();
        }

        return $employee;
    }

    /**
     * @throws EmployeeAlreadyExists
     */
    public function validateIdTypeAndIdentificationNumber(
        EmployeeId $id,
        EmployeeIdType $idType,
        EmployeeIdentificationNumber $identificationNumber
    ): void {
        $employee = $this->repository->byIdTypeAndIdentificationNumber($idType, $identificationNumber);

        if ($employee && !$employee->id()->equalsTo($id)) {
            throw new EmployeeAlreadyExists(EmployeeIdType::COLUMN, EmployeeIdentificationNumber::COLUMN);
        }
    }

    /**
     * @throws EmptyValue
     */
    public function generateEmail(
        EmployeeFirstName $firstName,
        EmployeeFirstSurname $firstSurname,
        EmployeeCountry $country,
        Employee $employee = null,
        string $id = ''
    ): EmployeeEmail {
        if ($employee
            && $employee->firstName()->equalsTo($firstName->value())
            && $employee->firstSurname()->equalsTo($firstSurname->value())
            && $employee->country()->equalsTo($country->value())) {
            return $employee->email();
        }

        $domain = EmployeeDomain::$domains[$country->value()];
        $name = str_replace(' ', '', $firstName->lower());
        $surName = str_replace(' ', '', $firstSurname->lower());
        $auxEmail = sprintf('%s.%s%s@%s', $name, $surName, $id, $domain);

        $newEmail = new EmployeeEmail($auxEmail);

        if ($this->repository->byEmail($newEmail)) {
            $rand = '.'.mt_rand();

            return $this->generateEmail($firstName, $firstSurname, $country, $employee, $rand);
        }

        return $newEmail;
    }

    /**
     * @throws Exception
     * @throws InvalidEmployeeDateAdmission
     */
    public function validateDateAdmission(EmployeeAdmissionDate $dateAdmission): void
    {
        $now = DateValueObject::now()->setTime(0, 0);
        $month = $now->sub(new DateInterval('P1M'));

        if ($month > $dateAdmission || $dateAdmission > $now) {
            throw new InvalidEmployeeDateAdmission();
        }
    }
}
