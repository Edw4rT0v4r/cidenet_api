<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee\Exception;

use Cidenet\Api\Domain\Shared\Exception\DomainException;

final class InvalidParameterCase extends DomainException
{
    public function __construct(string $parameter)
    {
        parent::__construct(sprintf(
            "The '%s' parameter only allows characters from A to Z, uppercase and without accents.",
            $parameter
        ), self::BAD_REQUEST);
    }
}
