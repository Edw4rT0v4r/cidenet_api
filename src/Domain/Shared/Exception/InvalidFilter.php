<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\Exception;

final class InvalidFilter extends DomainException
{
    public function __construct(string $filter)
    {
        parent::__construct(sprintf("The '%s' filter is invalid.", $filter), self::BAD_REQUEST);
    }
}
