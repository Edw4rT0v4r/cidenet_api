<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

final class EmployeeDomain
{
    public static array $domains = [
        EmployeeCountry::COUNTRY_COLOMBIA => 'cidenet.com.co',
        EmployeeCountry::COUNTRY_ESTADOS_UNIDOS => 'cidenet.com.us',
    ];
}
