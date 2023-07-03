<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;
    private User $wrongUser;
    private TaskStatus $taskStatus;
    private Task $task;
    private array $taskData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->wrongUser = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
        $this->task = Task::factory([
            'created_by_id' => $this->user->id,
        ])->create();
        $this->taskData = Task::factory()->make()->only([
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

    public function testCreatNonAuth(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertForbidden();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));

        $response->assertOk();
    }

    public function testStoreNonAuth(): void
    {
        $response = $this->post(route('tasks.store'), $this->taskData);

        $response->assertForbidden();
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $this->taskData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testEditNonAuth(): void
    {
        $response = $this->get(route('tasks.edit', $this->task));

        $response->assertForbidden();
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $this->task));

        $response->assertOk();
    }

    public function testUpdateNonAuth(): void
    {
        $response = $this->patch(route('tasks.update', $this->task), $this->taskData);

        $response->assertForbidden();
    }

    public function testUpdate(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $this->taskData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testDestroyNonAuth(): void
    {
        $response = $this->delete(route('tasks.destroy', $this->task));

        $response->assertForbidden();
    }

    public function testDestroyByWrongUser(): void
    {
        $response = $this->actingAs($this->wrongUser)->delete(route('tasks.destroy', $this->task));

        $response->assertForbidden();
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $this->task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }
}
