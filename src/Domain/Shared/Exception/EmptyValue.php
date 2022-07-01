<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\Exception;

final class EmptyValue extends DomainException
{
    public function __construct(string $parameter)
    {
        parent::__construct(sprintf("The '%s' parameter cannot be empty.", $parameter), self::BAD_REQUEST);
    }
}
