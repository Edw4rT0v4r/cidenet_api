<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeCreator;

use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeStatus;
use Cidenet\Api\Domain\Model\Employee\EmployeeValidation;
use Cidenet\Api\Domain\Model\Employee\Exception\EmployeeAlreadyExists;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeArea;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeDateAdmission;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterCase;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterLength;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\Exception\InvalidArgument;

class EmployeeCreatorValidator
{
    private EmployeeValidation $validation;

    public function __construct(EmployeeValidation $validation)
    {
        $this->validation = $validation;
    }

    /**
     * @throws EmployeeAlreadyExists
     * @throws EmptyValue
     * @throws InvalidArgument
     * @throws InvalidEmployeeArea
     * @throws InvalidEmployeeCountry
     * @throws InvalidEmployeeDateAdmission
     * @throws InvalidEmployeeIdentificationNumber
     * @throws InvalidParameterCase
     * @throws InvalidParameterLength
     */
    public function validate(EmployeeCreatorCommand $command): array
    {
        $id = EmployeeId::random();
        $firstName = new EmployeeFirstName($command->firstName());
        $otherName = new EmployeeOtherName($command->otherName());
        $firstSurname = new EmployeeFirstSurname($command->firstSurname());
        $secondSurname = new EmployeeSecondSurname($command->secondSurname());
        $country = new EmployeeCountry($command->country());

        $idType = new EmployeeIdType($command->idType());
        $identificationNumber = new EmployeeIdentificationNumber($command->identificationNumber());
        $this->validation->validateIdTypeAndIdentificationNumber(EmployeeId::random(), $idType, $identificationNumber);

        $dateAdmission = new EmployeeAdmissionDate($command->dateAdmission());
        $this->validation->validateDateAdmission($dateAdmission);

        $area = new EmployeeArea($command->area());
        $status = new EmployeeStatus(EmployeeStatus::STATUS_ACTIVE);

        return [
            $id,
            $firstName,
            $otherName,
            $firstSurname,
            $secondSurname,
            $this->validation->generateEmail($firstName, $firstSurname, $country),
            $country,
            $idType,
            $identificationNumber,
            $dateAdmission,
            $area,
            $status,
        ];
    }
}
