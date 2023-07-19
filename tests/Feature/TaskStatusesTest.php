<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @property array $newTaskStatusData
 * @property array $updateTaskStatusData
 */
class TaskStatusesTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;
    private TaskStatus $taskStatus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
        $this->newTaskStatusData = TaskStatus::factory()->make()->only([
            'name',
        ]);
        $this->updateTaskStatusData = TaskStatus::factory()->make()->only([
            'name',
        ]);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $this->newTaskStatusData);

        $this->assertDatabaseHas('task_statuses', $this->newTaskStatusData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $this->taskStatus));

        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('task_statuses.update', $this->taskStatus), $this->updateTaskStatusData);

        $this->assertDatabaseHas('task_statuses', $this->updateTaskStatusData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $this->taskStatus));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing('task_statuses', $this->taskStatus->only('id'));
    }
}
