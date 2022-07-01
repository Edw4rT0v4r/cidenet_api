<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Query\V1\Employee\EmployeeGet;

use Cidenet\Api\Domain\Model\Employee\Employee;
use Cidenet\Api\Infrastructure\Delivery\Response\JsonApi\Resource\V1\JsonApiEmployeeResource;

class EmployeeGetQueryService
{
    public function execute(Employee $employee): JsonApiEmployeeResource
    {
        return new JsonApiEmployeeResource($employee);
    }
}
