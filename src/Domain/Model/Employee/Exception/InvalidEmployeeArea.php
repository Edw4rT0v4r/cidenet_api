<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class InvalidEmployeeArea extends DomainException
{
    public function __construct(EmployeeArea $area)
    {
        parent::__construct(sprintf(
            "The area '%s' is not valid. Valid are (%s)",
            $area->value(),
            implode(', ', EmployeeArea::$area)
        ), self::BAD_REQUEST);
    }
}
