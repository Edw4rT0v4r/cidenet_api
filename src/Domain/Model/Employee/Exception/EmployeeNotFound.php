<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class EmployeeNotFound extends DomainException
{
    public function __construct()
    {
        parent::__construct('Employee not found.', self::NOT_FOUND);
    }
}
