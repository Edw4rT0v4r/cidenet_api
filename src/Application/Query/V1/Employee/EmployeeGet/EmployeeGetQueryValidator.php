<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Query\V1\Employee\EmployeeGet;

use Cidenet\Api\Domain\Model\Employee\Employee;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Cidenet\Api\Domain\Model\Employee\EmployeeValidation;
use Cidenet\Api\Domain\Model\Employee\Exception\EmployeeNotFound;
use Cidenet\Api\Domain\Shared\Exception\InvalidArgument;

class EmployeeGetQueryValidator
{
    private EmployeeValidation $validation;

    public function __construct(EmployeeValidation $validation)
    {
        $this->validation = $validation;
    }

    /**
     * @throws EmployeeNotFound
     * @throws InvalidArgument
     */
    public function validate(EmployeeGetQuery $command): Employee
    {
        return $this->validation->checkEmployeeExist(new EmployeeId($command->id()));
    }
}
