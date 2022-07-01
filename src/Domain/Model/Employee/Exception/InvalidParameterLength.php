<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class InvalidParameterLength extends DomainException
{
    public function __construct(string $parameter, int $length)
    {
        parent::__construct(
            sprintf("The '%s' parameter only allows '%d' characters.", $parameter, $length),
            self::BAD_REQUEST
        );
    }
}
