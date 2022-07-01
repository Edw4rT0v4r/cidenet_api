<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeArea;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\ValueObject\StringValueObject;

final class EmployeeArea extends StringValueObject
{
    public const COLUMN = 'area';

    public static array $area = [
        'Administración',
        'Financiera',
        'Compras',
        'Infraestructura',
        'Operación',
        'Talento Humano',
        'Servicios Varios',
    ];

    /**
     * @throws EmptyValue
     * @throws InvalidEmployeeArea
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->validateEmpty();
        $this->validateArea();
    }

    /**
     * @throws EmptyValue
     */
    private function validateEmpty(): void
    {
        if (!trim($this->value())) {
            throw new EmptyValue(self::COLUMN);
        }
    }

    /**
     * @throws InvalidEmployeeArea()
     */
    private function validateArea(): void
    {
        if (!in_array($this->value(), self::$area, true)) {
            throw new InvalidEmployeeArea($this);
        }
    }
}
