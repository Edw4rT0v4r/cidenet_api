<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Model\Employee\EmployeeStatus;
use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class InvalidEmployeeStatus extends DomainException
{
    public function __construct(EmployeeStatus $status)
    {
        parent::__construct(sprintf(
            "The status '%s' is not valid. Valid are (%s)",
            $status->value(),
            implode(', ', EmployeeStatus::$status)
        ), self::BAD_REQUEST);
    }
}
