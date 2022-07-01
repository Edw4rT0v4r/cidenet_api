<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

interface EmployeeRepositoryInterface
{
    public function eloquentEmployeeModel();

    public function byEmail(EmployeeEmail $email): ?Employee;

    public function byId(EmployeeId $id): ?Employee;

    public function byIdTypeAndIdentificationNumber(
        EmployeeIdType $idType,
        EmployeeIdentificationNumber $identificationNumber
    ): ?Employee;

    public function create(Employee $employee): EmployeeId;

    public function update(Employee $employee): void;

    public function delete(EmployeeId $id): void;
}
