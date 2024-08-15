<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;


class EmployeeTest extends TestCase
{
    use DatabaseMigrations;

    public function test_getEmployees_success(): void
    {
        Employee::factory()->count(3)->create();

        $response = $this->get('/api/employees');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'success', 'data'])
                ->has('data', 3, function (AssertableJson $json) {
                    $json->hasAll([
                        'id',
                        'first_name',
                        'last_name',
                        'prefix',
                        'number',
                        'contract_id',
                    ]);
                });
            });
    }
}
