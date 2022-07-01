<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Shared\Model\TimeAwareTrait;
use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;
use Exception;

class Employee
{
    use TimeAwareTrait;

    public const COLUMN_CREATE_AT = 'created_at';

    public const COLUMN_UPDATE_AT = 'updated_at';

    private EmployeeId $id;
    private EmployeeFirstName $firstName;
    private EmployeeOtherName $otherName;
    private EmployeeFirstSurname $firstSurname;
    private EmployeeSecondSurname $secondSurname;
    private EmployeeEmail $email;
    private EmployeeCountry $country;
    private EmployeeIdType $idType;
    private EmployeeIdentificationNumber $identificationNumber;
    private EmployeeAdmissionDate $dateAdmission;
    private EmployeeArea $area;
    private EmployeeStatus $status;

    /**
     * @throws Exception
     */
    private function __construct(
        EmployeeId $id,
        EmployeeFirstName $firstName,
        EmployeeOtherName $otherName,
        EmployeeFirstSurname $firstSurname,
        EmployeeSecondSurname $secondSurname,
        EmployeeEmail $email,
        EmployeeCountry $country,
        EmployeeIdType $idType,
        EmployeeIdentificationNumber $identificationNumber,
        EmployeeAdmissionDate $dateAdmission,
        EmployeeArea $area,
        EmployeeStatus $status,
        DateValueObject $createdAt,
        ?DateValueObject $updateAt
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->otherName = $otherName;
        $this->firstSurname = $firstSurname;
        $this->secondSurname = $secondSurname;
        $this->email = $email;
        $this->country = $country;
        $this->idType = $idType;
        $this->identificationNumber = $identificationNumber;
        $this->dateAdmission = $dateAdmission;
        $this->area = $area;
        $this->status = $status;
        $this->setCreatedAt($createdAt);

        if ($updateAt) {
            $this->setUpdateAt($updateAt);
        }
    }

    public function __toArray(): array
    {
        return [
            EmployeeId::COLUMN => $this->id()->value(),
            EmployeeFirstName::COLUMN => $this->firstName()->value(),
            EmployeeOtherName::COLUMN => $this->otherName()->value(),
            EmployeeFirstSurname::COLUMN => $this->firstSurname()->value(),
            EmployeeSecondSurname::COLUMN => $this->secondSurname()->value(),
            EmployeeEmail::COLUMN => $this->email()->value(),
            EmployeeCountry::COLUMN => $this->country()->value(),
            EmployeeIdType::COLUMN => $this->idType()->value(),
            EmployeeIdentificationNumber::COLUMN => $this->identificationNumber()->value(),
            EmployeeAdmissionDate::COLUMN => $this->dateAdmission()->toString(),
            EmployeeArea::COLUMN => $this->area()->value(),
            EmployeeStatus::COLUMN => $this->status()->value(),
            self::COLUMN_CREATE_AT => $this->createdAt()->toString(DateValueObject::FORMAT_TIME),
            self::COLUMN_UPDATE_AT => $this->updatedAt()?->toString(DateValueObject::FORMAT_TIME),
        ];
    }

    public function id(): EmployeeId
    {
        return $this->id;
    }

    public function firstName(): EmployeeFirstName
    {
        return $this->firstName;
    }

    public function otherName(): EmployeeOtherName
    {
        return $this->otherName;
    }

    public function firstSurname(): EmployeeFirstSurname
    {
        return $this->firstSurname;
    }

    public function secondSurname(): EmployeeSecondSurname
    {
        return $this->secondSurname;
    }

    public function email(): EmployeeEmail
    {
        return $this->email;
    }

    public function country(): EmployeeCountry
    {
        return $this->country;
    }

    public function idType(): EmployeeIdType
    {
        return $this->idType;
    }

    public function identificationNumber(): EmployeeIdentificationNumber
    {
        return $this->identificationNumber;
    }

    public function dateAdmission(): EmployeeAdmissionDate
    {
        return $this->dateAdmission;
    }

    public function area(): EmployeeArea
    {
        return $this->area;
    }

    public function status(): EmployeeStatus
    {
        return $this->status;
    }

    /**
     * @throws Exception
     */
    public static function create(
        EmployeeId $id,
        EmployeeFirstName $firstName,
        EmployeeOtherName $otherName,
        EmployeeFirstSurname $firstSurname,
        EmployeeSecondSurname $secondSurname,
        EmployeeEmail $email,
        EmployeeCountry $country,
        EmployeeIdType $idType,
        EmployeeIdentificationNumber $identificationNumber,
        EmployeeAdmissionDate $dateAdmission,
        EmployeeArea $area,
        EmployeeStatus $status,
        DateValueObject $createdAt,
        ?DateValueObject $updateAt = null,
    ): self {
        return new self(
            $id,
            $firstName,
            $otherName,
            $firstSurname,
            $secondSurname,
            $email,
            $country,
            $idType,
            $identificationNumber,
            $dateAdmission,
            $area,
            $status,
            $createdAt,
            $updateAt
        );
    }

    public function update(
        EmployeeFirstName $firstName,
        EmployeeOtherName $otherName,
        EmployeeFirstSurname $firstSurname,
        EmployeeSecondSurname $secondSurname,
        EmployeeEmail $email,
        EmployeeCountry $country,
        EmployeeIdType $idType,
        EmployeeIdentificationNumber $identificationNumber,
        EmployeeAdmissionDate $dateAdmission,
        EmployeeArea $area
    ): self {
        return new self(
            $this->id(),
            $firstName,
            $otherName,
            $firstSurname,
            $secondSurname,
            $email,
            $country,
            $idType,
            $identificationNumber,
            $dateAdmission,
            $area,
            $this->status(),
            $this->createdAt(),
            DateValueObject::now()
        );
    }
}
