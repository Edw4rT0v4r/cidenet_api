<?php

declare(strict_types=1);

namespace Tests\Feature\Infrastructure\Delivery\Action\V1\Employee;

use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 */
class CreateEmployeeActionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_create_employee(): void
    {
        $firstName = strtoupper($this->faker->unique()->firstName);
        $firstSurname = strtoupper($this->faker->unique()->lastName);
        $country = $this->faker->randomElement(EmployeeCountry::$countries);

        $data = [
            EmployeeFirstName::COLUMN => $firstName,
            EmployeeOtherName::COLUMN => $this->faker->boolean ? $firstName : null,
            EmployeeFirstSurname::COLUMN => $firstSurname,
            EmployeeSecondSurname::COLUMN => $firstSurname,
            EmployeeCountry::COLUMN => $country,
            EmployeeIdType::COLUMN => $this->faker->randomElement(EmployeeIdType::$IDType),
            EmployeeIdentificationNumber::COLUMN => $this->faker->unique()->numerify('###############'),
            EmployeeAdmissionDate::COLUMN => $this->faker->dateTimeBetween('-1 months')->format(DateValueObject::FORMAT),
            EmployeeArea::COLUMN => $this->faker->randomElement(EmployeeArea::$area),
        ];

        $response = $this->postJson('/api/v1/employees', $data);
        $response->assertCreated();

        $this->assertDatabaseHas('employees', $data);
    }

    public function test_create_employee_fail(): void
    {
        $firstName = strtoupper($this->faker->unique()->firstName);
        $firstSurname = strtoupper($this->faker->unique()->lastName);
        $country = $this->faker->randomElement(EmployeeCountry::$countries);

        $data = [
            EmployeeOtherName::COLUMN => $this->faker->boolean ? $firstName : null,
            EmployeeFirstSurname::COLUMN => $firstSurname,
            EmployeeSecondSurname::COLUMN => $firstSurname,
            EmployeeCountry::COLUMN => $country,
            EmployeeIdType::COLUMN => $this->faker->randomElement(EmployeeIdType::$IDType),
            EmployeeIdentificationNumber::COLUMN => $this->faker->unique()->numerify('###############'),
            EmployeeAdmissionDate::COLUMN => $this->faker->dateTimeBetween('-1 months')->format(DateValueObject::FORMAT),
            EmployeeArea::COLUMN => $this->faker->randomElement(EmployeeArea::$area),
        ];

        $response = $this->postJson('/api/v1/employees', $data);
        $response->assertStatus(400);
    }

    public function test_fail_create_employee_admission_date_out_of_range(): void
    {
        $firstName = strtoupper($this->faker->unique()->firstName);
        $firstSurname = strtoupper($this->faker->unique()->lastName);
        $country = $this->faker->randomElement(EmployeeCountry::$countries);

        $data = [
            EmployeeFirstName::COLUMN => $firstName,
            EmployeeOtherName::COLUMN => $this->faker->boolean ? $firstName : null,
            EmployeeFirstSurname::COLUMN => $firstSurname,
            EmployeeSecondSurname::COLUMN => strtoupper($this->faker->lastName),
            EmployeeCountry::COLUMN => $country,
            EmployeeIdType::COLUMN => $this->faker->randomElement(EmployeeIdType::$IDType),
            EmployeeIdentificationNumber::COLUMN => $this->faker->unique()->numerify('###############'),
            EmployeeAdmissionDate::COLUMN => $this->faker->dateTimeBetween(
                '-2 months',
                '-1 months'
            )->format(DateValueObject::FORMAT),
            EmployeeArea::COLUMN => $this->faker->randomElement(EmployeeArea::$area),
        ];

        $response = $this->postJson('/api/v1/employees', $data);
        $response->assertStatus(400);
    }
}
