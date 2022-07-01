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
class GetEmployeeActionTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_get_employee(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->getJson("/api/v1/employees/{$employee->id}");
        $response->assertOk();
    }

    public function test_get_employee_not_found(): void
    {
        $id = $this->faker->uuid();

        $response = $this->getJson("/api/v1/employees/{$id}");
        $response->assertNotFound();
    }

    public function test_get_employee_invalid_id(): void
    {
        $id = $this->faker->slug(15);

        $response = $this->getJson("/api/v1/employees/{$id}");
        $response->assertStatus(400);
    }
}
