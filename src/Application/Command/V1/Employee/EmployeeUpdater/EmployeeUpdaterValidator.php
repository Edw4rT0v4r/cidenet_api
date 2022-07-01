<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeUpdater;

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
use Cidenet\Api\Domain\Model\Employee\EmployeeValidation;
use Cidenet\Api\Domain\Model\Employee\Exception\EmployeeAlreadyExists;
use Cidenet\Api\Domain\Model\Employee\Exception\EmployeeNotFound;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeArea;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeDateAdmission;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidEmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterCase;
use Cidenet\Api\Domain\Model\Employee\Exception\InvalidParameterLength;
use Cidenet\Api\Domain\Shared\Exception\EmptyValue;
use Cidenet\Api\Domain\Shared\Exception\InvalidArgument;

class EmployeeUpdaterValidator
{
    private EmployeeValidation $validation;

    public function __construct(EmployeeValidation $validation)
    {
        $this->validation = $validation;
    }

    /**
     * @throws EmployeeAlreadyExists
     * @throws EmployeeNotFound
     * @throws EmptyValue
     * @throws InvalidArgument
     * @throws InvalidEmployeeArea
     * @throws InvalidEmployeeCountry
     * @throws InvalidEmployeeDateAdmission
     * @throws InvalidEmployeeIdentificationNumber
     * @throws InvalidParameterCase
     * @throws InvalidParameterLength
     */
    public function validate(EmployeeUpdaterCommand $command): array
    {
        $id = new EmployeeId($command->id());
        $employee = $this->validation->checkEmployeeExist($id);

        $firstName = new EmployeeFirstName($command->firstName());
        $otherName = new EmployeeOtherName($command->otherName());
        $firstSurname = new EmployeeFirstSurname($command->firstSurname());
        $secondSurname = new EmployeeSecondSurname($command->secondSurname());
        $country = new EmployeeCountry($command->country());

        $idType = new EmployeeIdType($command->idType());
        $identificationNumber = new EmployeeIdentificationNumber($command->identificationNumber());
        $this->validation->validateIdTypeAndIdentificationNumber($id, $idType, $identificationNumber);

        $dateAdmission = new EmployeeAdmissionDate($command->dateAdmission());
        $this->validation->validateDateAdmission($dateAdmission);

        $area = new EmployeeArea($command->area());

        return [
            $employee,
            $firstName,
            $otherName,
            $firstSurname,
            $secondSurname,
            $this->validation->generateEmail($firstName, $firstSurname, $country, $employee),
            $country,
            $idType,
            $identificationNumber,
            $dateAdmission,
            $area,
        ];
    }
}
