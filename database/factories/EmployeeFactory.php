<?php

declare(strict_types=1);

namespace Database\Factories;

use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeDomain;
use Cidenet\Api\Domain\Model\Employee\EmployeeEmail;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeStatus;
use Cidenet\Api\Domain\Shared\Exception\DomainException;
use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @throws DomainException
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->regexify('[A-Z]{20}');
        $firstSurname = $this->faker->regexify('[A-Z]{20}');
        $country = $this->faker->randomElement(EmployeeCountry::$countries);
        $domain = EmployeeDomain::$domains[$country];
        $email = "{$firstName}.{$firstSurname}@{$domain}";

        return [
            EmployeeId::COLUMN => (EmployeeId::random())->value(),
            EmployeeFirstName::COLUMN => $firstName,
            EmployeeOtherName::COLUMN => $this->faker->boolean ? $this->faker->regexify('[A-Z]{50}') : null,
            EmployeeFirstSurname::COLUMN => $firstSurname,
            EmployeeSecondSurname::COLUMN => $this->faker->regexify('[A-Z]{20}'),
            EmployeeEmail::COLUMN => strtolower($email),
            EmployeeCountry::COLUMN => $country,
            EmployeeIdType::COLUMN => $this->faker->randomElement(EmployeeIdType::$IDType),
            EmployeeIdentificationNumber::COLUMN => $this->faker->regexify('[0-9a-zA-Z-]{20}'),
            EmployeeAdmissionDate::COLUMN => $this->faker->dateTimeBetween('-1 months')->format(DateValueObject::FORMAT),
            EmployeeArea::COLUMN => $this->faker->randomElement(EmployeeArea::$area),
            EmployeeStatus::COLUMN => $this->faker->randomElement(EmployeeStatus::$status),
        ];
    }
}
