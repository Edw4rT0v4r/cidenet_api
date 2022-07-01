<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class DomainException extends Exception
{
    public const BAD_REQUEST = Response::HTTP_BAD_REQUEST;

    public const NOT_FOUND = Response::HTTP_NOT_FOUND;
}
