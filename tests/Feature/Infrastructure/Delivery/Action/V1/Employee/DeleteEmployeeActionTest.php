<?php

declare(strict_types=1);

namespace Tests\Feature\Infrastructure\Delivery\Action\V1\Employee;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 */
class DeleteEmployeeActionTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_delete_employee(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->deleteJson("/api/v1/employees/{$employee->id}");
        $response->assertStatus(202);

        $this->assertDatabaseMissing('employees', $employee->toArray());
    }

    public function test_delete_employee_not_found(): void
    {
        $id = $this->faker->uuid();

        $response = $this->deleteJson("/api/v1/employees/{$id}");
        $response->assertNotFound();
    }

    public function test_delete_employee_invalida_id(): void
    {
        $id = $this->faker->slug(15);

        $response = $this->deleteJson("/api/v1/employees/{$id}");
        $response->assertStatus(400);
    }
}
