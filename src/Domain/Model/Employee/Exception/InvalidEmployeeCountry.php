<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class InvalidEmployeeCountry extends DomainException
{
    public function __construct(EmployeeCountry $country)
    {
        parent::__construct(sprintf(
            "The country '%s' is not valid. Valid are (%s)",
            $country->value(),
            implode(', ', EmployeeCountry::$countries)
        ), self::BAD_REQUEST);
    }
}
