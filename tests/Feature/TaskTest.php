<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @property array $newTaskData
 * @property array $updateTaskData
 */
class TaskTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->task = Task::factory([
            'created_by_id' => $this->user->id,
        ])->create();
        $this->newTaskData = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
        $this->updateTaskData = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function testShow(): void
    {
        $response = $this->get(route('tasks.show', $this->task));

        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $this->newTaskData);

        $this->assertDatabaseHas('tasks', $this->newTaskData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $this->task));

        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $this->updateTaskData);

        $this->assertDatabaseHas('tasks', $this->updateTaskData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $this->task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', $this->task->only('id'));
    }
}
