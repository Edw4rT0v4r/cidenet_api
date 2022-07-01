<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeUpdater;

use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeCountry;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;

class EmployeeUpdaterCommandHandler
{
    private EmployeeUpdaterService $service;
    private EmployeeUpdaterValidator $validator;

    public function __construct(EmployeeUpdaterService $service, EmployeeUpdaterValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @throws EmptyValue
     * @throws InvalidEmployeeCountry
     */
    public function handle(EmployeeUpdaterCommand $command): void
    {
        $this->service->execute(...$this->validator->validate($command));
    }
}
