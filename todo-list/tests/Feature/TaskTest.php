<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;


class TaskTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     */
    public function test_getAllTasks_success(): void
    {
        Task::factory()->count(4)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'success', 'data'])
                    ->has('data', 4, function (AssertableJson $json) {
                        $json->hasAll([
                            'id',
                            'name',
                            'completed',
                            'created_at',
                            'updated_at'
                        ]);
                    });
            });
    }

    public function test_addTask_success(): void
    {
        $testData = [
            'name' => 'test task'
        ];

        $response = $this->post('/api/tasks', $testData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tasks', $testData);
    }

    public function test_deleteTask_invalidId()
    {
        Task::factory()->create();

        $response = $this->delete('/api/tasks/2');

        $response->assertStatus(400)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'success']);
            });
    }

    public function test_deleteTask_success()
    {
        Task::factory()->create();

        $response = $this->delete('/api/tasks/1');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'success']);
            });

        $this->assertDatabaseEmpty('tasks');
    }

    public function test_markTaskCompleted_invalidId()
    {
        Task::factory()->create();

        $response = $this->put('/api/tasks/2');

        $response->assertStatus(400)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'success']);
            });
    }

    public function test_markTaskCompleted_success()
    {
        Task::factory()->create();

        $response = $this->put('/api/tasks/1');

        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'success']);
            });
    }
}
