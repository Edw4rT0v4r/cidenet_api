<?php

declare(strict_types=1);

namespace Tests\Feature\Infrastructure\Delivery\Action\V1\Employee;

use App\Models\Employee;
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
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 */
class UpdateEmployeeActionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_update_employee(): void
    {
        $employee = Employee::factory()->create();
        $firstName = strtoupper($this->faker->unique()->firstName);
        $firstSurname = strtoupper($this->faker->unique()->lastName);

        $data = [
            EmployeeFirstName::COLUMN => $firstName,
            EmployeeOtherName::COLUMN => $employee->{EmployeeOtherName::COLUMN},
            EmployeeFirstSurname::COLUMN => $firstSurname,
            EmployeeSecondSurname::COLUMN => $employee->{EmployeeSecondSurname::COLUMN},
            EmployeeCountry::COLUMN => $employee->{EmployeeCountry::COLUMN},
            EmployeeIdType::COLUMN => $employee->{EmployeeIdType::COLUMN},
            EmployeeIdentificationNumber::COLUMN => $employee->{EmployeeIdentificationNumber::COLUMN},
            EmployeeAdmissionDate::COLUMN => $employee->{EmployeeAdmissionDate::COLUMN},
            EmployeeArea::COLUMN => $employee->{EmployeeArea::COLUMN},
        ];

        $response = $this->putJson("/api/v1/employees/{$employee->{EmployeeId::COLUMN}}", $data);
        $response->assertCreated();

        $this->assertDatabaseHas('employees', $data);
    }

    public function test_update_employee_not_found(): void
    {
        $id = $this->faker->uuid();

        $response = $this->putJson("/api/v1/employees/{$id}");
        $response->assertNotFound();
    }

    public function test_update_employee_invalida_id(): void
    {
        $id = $this->faker->slug(15);

        $response = $this->putJson("/api/v1/employees/{$id}");
        $response->assertStatus(400);
    }
}
