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
        $this->taskStatus = TaskStatus::factory([
            'creator_id' => $this->user->id,
        ])->create();
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

    public function test_index(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function test_show(): void
    {
        $response = $this->get(route('tasks.show', $this->task));

        $response->assertOk();
    }

    public function test_create_non_auth(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertForbidden();
    }

    public function test_create(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));

        $response->assertOk();
    }

    public function test_store_non_auth(): void
    {
        $response = $this->post(route('tasks.store'), $this->taskData);

        $response->assertForbidden();
    }

    public function test_store(): void
    {
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $this->taskData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function test_edit_non_auth(): void
    {
        $response = $this->get(route('tasks.edit', $this->task));

        $response->assertForbidden();
    }

    public function test_edit(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $this->task));

        $response->assertOk();
    }

    public function test_update_non_auth(): void
    {
        $response = $this->patch(route('tasks.update', $this->task), $this->taskData);

        $response->assertForbidden();
    }

    public function test_update(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $this->taskData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.show', $this->task));
    }

    public function test_destroy_non_auth(): void
    {
        $response = $this->delete(route('tasks.destroy', $this->task));

        $response->assertForbidden();
    }

    public function test_destroy_by_wrong_user(): void
    {
        $response = $this->actingAs($this->wrongUser)->delete(route('tasks.destroy', $this->task));

        $response->assertForbidden();
    }

    public function test_destroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $this->task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }
}
