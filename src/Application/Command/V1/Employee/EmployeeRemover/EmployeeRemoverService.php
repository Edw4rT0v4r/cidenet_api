<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeRemover;

use Cidenet\Api\Domain\Model\Employee\Employee;
use Cidenet\Api\Domain\Model\Employee\EmployeeRepositoryInterface;

class EmployeeRemoverService
{
    private EmployeeRepositoryInterface $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Employee $employee): void
    {
        $this->repository->delete($employee->id());
    }
}
