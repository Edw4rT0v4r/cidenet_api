<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class EmployeeAlreadyExists extends DomainException
{
    public function __construct(...$params)
    {
        parent::__construct(
            sprintf("The employee with ('%s') already exists.", implode("', '", $params)),
            self::NOT_FOUND
        );
    }
}
