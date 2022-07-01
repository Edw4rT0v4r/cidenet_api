<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\ValueObject\StringValueObject;

final class EmployeeIdType extends StringValueObject
{
    public const COLUMN = 'id_type';

    public const ID_TYPE_CEDULA_CIUDADANIA = 'Cédula de ciudadanía';
    public const ID_TYPE_CEDULA_EXTRANJERIA = 'Cedula de extranjeria';
    public const ID_TYPE_PASAPORTE = 'Pasaporte';
    public const ID_TYPE_PERMISO_ESPECIAL = 'Permiso especial';

    public static array $IDType = [
        self::ID_TYPE_CEDULA_CIUDADANIA,
        self::ID_TYPE_CEDULA_EXTRANJERIA,
        self::ID_TYPE_PASAPORTE,
        self::ID_TYPE_PERMISO_ESPECIAL,
    ];

    /**
     * @throws EmptyValue
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->validateEmpty();
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
}
