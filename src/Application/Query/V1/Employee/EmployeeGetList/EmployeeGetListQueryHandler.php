<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Query\V1\Employee\EmployeeGetList;

use Cidenet\Api\Domain\Shared\Exception\InvalidFilter;
use Cidenet\Api\Domain\Shared\Exception\InvalidSort;
use Cidenet\Api\Domain\Shared\Exception\InvalidSortDirection;
use Cidenet\Api\Infrastructure\Delivery\Response\JsonApi\Collection\V1\JsonApiEmployeeCollection;

class EmployeeGetListQueryHandler
{
    private EmployeeGetListQueryService $service;
    private EmployeeGetListQueryValidator $validator;

    public function __construct(EmployeeGetListQueryService $service, EmployeeGetListQueryValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @throws InvalidFilter
     * @throws InvalidSort
     * @throws InvalidSortDirection
     */
    public function handle(EmployeeGetListQuery $command): JsonApiEmployeeCollection
    {
        return $this->service->execute($this->validator->validate($command));
    }
}
