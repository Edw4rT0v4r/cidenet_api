<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class InvalidEmployeeIdentificationNumber extends DomainException
{
    public function __construct(string $parameter)
    {
        parent::__construct(
            sprintf("The '%s' parameter only allows characters from A to Z, 0 to 9 and -.", $parameter),
            self::BAD_REQUEST
        );
    }
}
