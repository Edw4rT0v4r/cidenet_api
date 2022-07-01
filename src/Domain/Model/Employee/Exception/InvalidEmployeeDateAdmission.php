<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class InvalidEmployeeDateAdmission extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            'The admission date is not in the allowed range of a maximum of one month to the current date.',
            self::BAD_REQUEST
        );
    }
}
