<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeCreator;

use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeCountry;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;

class EmployeeCreatorCommandHandler
{
    private EmployeeCreatorService $service;
    private EmployeeCreatorValidator $validator;

    public function __construct(EmployeeCreatorService $service, EmployeeCreatorValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @throws EmptyValue
     * @throws InvalidEmployeeCountry
     * @throws \Exception
     */
    public function handle(EmployeeCreatorCommand $command): EmployeeId
    {
        return $this->service->execute(...$this->validator->validate($command));
    }
}
