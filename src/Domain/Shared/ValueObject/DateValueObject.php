<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\ValueObject;

use DateTimeImmutable;
use DateTimeZone;
use Exception;

class DateValueObject extends DateTimeImmutable
{
    public const FORMAT = 'Y-m-d';

    public const FORMAT_TIME = 'Y-m-d H:i:s';

    public const DEFAULT_UTC = 'UTC';

    /**
     * @throws Exception
     */
    public static function fromString(string $date): self
    {
        return new self($date, new DateTimeZone(self::DEFAULT_UTC));
    }

    public function toString(string $format = null): string
    {
        return $this->format($format ?? self::FORMAT);
    }

    /**
     * @throws Exception
     */
    public static function now(): self
    {
        return new self('now', new DateTimeZone(self::DEFAULT_UTC));
    }

    /**
     * @param mixed $format
     * @param mixed $datetime
     * @param mixed $timezone
     *
     * @throws Exception
     */
    public static function createFromFormat($format, $datetime, $timezone = self::DEFAULT_UTC): self
    {
        $date = parent::createFromFormat($format, $datetime, new DateTimeZone($timezone));

        return self::fromString($date->format(self::FORMAT));
    }
}
