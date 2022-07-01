<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\Exception;

final class InvalidArgument extends DomainException
{
    public function __construct(string $parameter)
    {
        parent::__construct(sprintf("The '%s' parameter is invalid.", $parameter), self::BAD_REQUEST);
    }
}
