<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeRemover;

use Cidenet\Api\Domain\Model\Employee\Exception\EmployeeNotFound;
use Cidenet\Api\Domain\Shared\Exception\InvalidArgument;

class EmployeeRemoverCommandHandler
{
    private EmployeeRemoverService $service;
    private EmployeeRemoverValidator $validator;

    public function __construct(EmployeeRemoverService $service, EmployeeRemoverValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @throws EmployeeNotFound
     * @throws InvalidArgument
     */
    public function handle(EmployeeRemoverCommand $command): void
    {
        $this->service->execute($this->validator->validate($command));
    }
}
