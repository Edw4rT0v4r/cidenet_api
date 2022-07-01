<?php

declare(strict_types=1);

namespace Tests\Feature\Infrastructure\Delivery\Action\V1\Employee;

use App\Models\Employee;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 */
class GetEmployeeListActionTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_list_employees(): void
    {
        $numberEmployees = 10;

        Employee::factory()->count($numberEmployees)->create();

        $response = $this->getJson('/api/v1/employees');
        $response->assertOk();
        $response->assertJsonCount($numberEmployees, 'data');
    }

    public function test_list_employees_empty(): void
    {
        $response = $this->getJson('/api/v1/employees');
        $response->assertOk();
        $response->assertJsonCount(0, 'data');
    }

    public function test_list_employees_bad_filter(): void
    {
        $filter = 'filter[asd]=asd';
        $response = $this->getJson("/api/v1/employees?{$filter}");
        $response->assertStatus(400);
    }

    public function test_list_employees_bad_sort(): void
    {
        $sort = 'sort[asd]=desc';
        $response = $this->getJson("/api/v1/employees?{$sort}");
        $response->assertStatus(400);
    }

    public function test_list_employees_bad_sort_direction(): void
    {
        $employeeFirstName = EmployeeFirstName::COLUMN;
        $sort = "sort[{$employeeFirstName}]=asd";
        $response = $this->getJson("/api/v1/employees?{$sort}");
        $response->assertStatus(400);
    }
}
