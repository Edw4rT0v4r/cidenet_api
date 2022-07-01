<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Query\V1\Employee\EmployeeGetList;

use Cidenet\Api\Infrastructure\Delivery\Response\JsonApi\Collection\V1\JsonApiEmployeeCollection;

class EmployeeGetListQueryService
{
    public function execute($employeeCollection): JsonApiEmployeeCollection
    {
        return new JsonApiEmployeeCollection($employeeCollection);
    }
}
