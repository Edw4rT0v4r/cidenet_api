<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Query\V1\Employee\EmployeeGet;

use Cidenet\Api\Domain\Model\Employee\Exception\EmployeeNotFound;
use Cidenet\Api\Domain\Shared\Exception\InvalidArgument;
use Cidenet\Api\Infrastructure\Delivery\Response\JsonApi\Resource\V1\JsonApiEmployeeResource;

class EmployeeGetQueryHandler
{
    private EmployeeGetQueryService $service;
    private EmployeeGetQueryValidator $validator;

    public function __construct(EmployeeGetQueryService $service, EmployeeGetQueryValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @throws EmployeeNotFound
     * @throws InvalidArgument
     */
    public function handle(EmployeeGetQuery $command): JsonApiEmployeeResource
    {
        return $this->service->execute($this->validator->validate($command));
    }
}
