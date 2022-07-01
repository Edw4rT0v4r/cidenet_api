<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Command\V1\Employee\EmployeeCreator;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmployeeCreatorCommand
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    private string $firstName;
    private ?string $otherName;
    private string $firstSurname;
    private string $secondSurname;
    private string $country;
    private string $idType;
    private string $identificationNumber;
    private string $dateAdmission;
    private string $area;

    public function __construct(
        string $firstName,
        ?string $otherName,
        string $firstSurname,
        string $secondSurname,
        string $country,
        string $idType,
        string $identificationNumber,
        string $dateAdmission,
        string $area
    ) {
        $this->firstName = $firstName;
        $this->otherName = $otherName;
        $this->firstSurname = $firstSurname;
        $this->secondSurname = $secondSurname;
        $this->country = $country;
        $this->idType = $idType;
        $this->identificationNumber = $identificationNumber;
        $this->dateAdmission = $dateAdmission;
        $this->area = $area;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function otherName(): ?string
    {
        return $this->otherName;
    }

    public function firstSurname(): string
    {
        return $this->firstSurname;
    }

    public function secondSurname(): string
    {
        return $this->secondSurname;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function idType(): string
    {
        return $this->idType;
    }

    public function identificationNumber(): string
    {
        return $this->identificationNumber;
    }

    public function dateAdmission(): string
    {
        return $this->dateAdmission;
    }

    public function area(): string
    {
        return $this->area;
    }
}
