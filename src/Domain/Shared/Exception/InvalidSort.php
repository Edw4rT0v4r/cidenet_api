<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\Exception;

final class InvalidSort extends DomainException
{
    public function __construct(string $sort)
    {
        parent::__construct(sprintf("The '%s' sort is invalid.", $sort), self::BAD_REQUEST);
    }
}
