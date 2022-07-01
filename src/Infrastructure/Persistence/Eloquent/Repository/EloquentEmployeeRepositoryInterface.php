<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Persistence\Eloquent\Repository;

use App\Models\Employee as EloquentEmployeeModel;
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
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeArea;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeStatus;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterCase;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterLength;
use Cidenet\Api\Domain\Shared\Exception\DomainException;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\Exception\InvalidArgument;
use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;
use Exception;

class EloquentEmployeeRepositoryInterface implements EmployeeRepositoryInterface
{
    private EloquentEmployeeModel $eloquentEmployeeModel;

    public function __construct()
    {
        $this->eloquentEmployeeModel = new EloquentEmployeeModel();
    }

    public function eloquentEmployeeModel(): EloquentEmployeeModel
    {
        return $this->eloquentEmployeeModel;
    }

    /**
     * @throws InvalidEmployeeCountry
     * @throws EmptyValue
     * @throws Exception
     */
    public function byId(EmployeeId $id): ?Employee
    {
        $employee = $this->eloquentEmployeeModel()->find($id->value());

        if (!$employee) {
            return null;
        }

        return $this->hydrateEmployee($employee);
    }

    /**
     * @throws InvalidEmployeeCountry
     * @throws EmptyValue
     * @throws Exception
     */
    public function byEmail(EmployeeEmail $email): ?Employee
    {
        $employee = $this->eloquentEmployeeModel()
            ->where(EmployeeEmail::COLUMN, 'LIKE', "%{$email->value()}%")
            ->first()
        ;

        if (!$employee) {
            return null;
        }

        return $this->hydrateEmployee($employee);
    }

    /**
     * @throws InvalidEmployeeCountry
     * @throws EmptyValue
     * @throws Exception
     */
    public function byIdTypeAndIdentificationNumber(
        EmployeeIdType $idType,
        EmployeeIdentificationNumber $identificationNumber
    ): ?Employee {
        $employee = $this->eloquentEmployeeModel()
            ->where(EmployeeIdType::COLUMN, $idType->value())
            ->where(EmployeeIdentificationNumber::COLUMN, $identificationNumber->value())
            ->first()
        ;

        if (!$employee) {
            return null;
        }

        return $this->hydrateEmployee($employee);
    }

    /**
     * @throws InvalidArgument
     */
    public function create(Employee $employee): EmployeeId
    {
        $id = $this->eloquentEmployeeModel()->create($employee->__toArray())->{EmployeeId::COLUMN};

        return new EmployeeId($id);
    }

    public function update(Employee $employee): void
    {
        $this->eloquentEmployeeModel()
            ->findOrFail($employee->id()->value())
            ->update($employee->__toArray())
        ;
    }

    public function delete(EmployeeId $id): void
    {
        $employee = $this->eloquentEmployeeModel()->find($id->value());
        $employee->delete();
    }

    /**
     * @throws DomainException
     * @throws EmptyValue
     * @throws Exception
     * @throws InvalidEmployeeArea
     * @throws InvalidEmployeeCountry
     * @throws InvalidEmployeeIdentificationNumber
     * @throws InvalidEmployeeStatus
     * @throws InvalidParameterCase
     * @throws InvalidParameterLength
     */
    private function hydrateEmployee(EloquentEmployeeModel $employee): Employee
    {
        return Employee::create(
            new EmployeeId($employee->{EmployeeId::COLUMN}),
            new EmployeeFirstName($employee->{EmployeeFirstName::COLUMN}),
            new EmployeeOtherName($employee->{EmployeeOtherName::COLUMN}),
            new EmployeeFirstSurname($employee->{EmployeeFirstSurname::COLUMN}),
            new EmployeeSecondSurname($employee->{EmployeeSecondSurname::COLUMN}),
            new EmployeeEmail($employee->{EmployeeEmail::COLUMN}),
            new EmployeeCountry($employee->{EmployeeCountry::COLUMN}),
            new EmployeeIdType($employee->{EmployeeIdType::COLUMN}),
            new EmployeeIdentificationNumber($employee->{EmployeeIdentificationNumber::COLUMN}),
            new EmployeeAdmissionDate($employee->{EmployeeAdmissionDate::COLUMN}),
            new EmployeeArea($employee->{EmployeeArea::COLUMN}),
            new EmployeeStatus($employee->{EmployeeStatus::COLUMN}),
            DateValueObject::fromString($employee->{Employee::COLUMN_CREATE_AT}->format(DateValueObject::FORMAT_TIME)),
            $employee->{Employee::COLUMN_UPDATE_AT}
                ? DateValueObject::fromString($employee->{Employee::COLUMN_UPDATE_AT}->format(DateValueObject::FORMAT_TIME))
                : null,
        );
    }
}
