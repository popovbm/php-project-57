<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskStatusesTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;
    private User $wrongUser;
    private TaskStatus $taskStatus;
    private array $taskStatusData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->wrongUser = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
        $this->taskStatusData = TaskStatus::factory()->make()->only([
            'name',
        ]);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertOk();
    }

    public function testCreateNonAuth(): void
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertForbidden();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testStoreNonAuth(): void
    {
        $response = $this->post(route('task_statuses.store'), $this->taskStatusData);

        $response->assertForbidden();
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $this->taskStatusData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testEditNonAuth(): void
    {
        $response = $this->get(route('task_statuses.edit', $this->taskStatus));

        $response->assertForbidden();
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $this->taskStatus));

        $response->assertOk();
    }

    public function testUpdateNonAuth(): void
    {
        $response = $this->patch(route('task_statuses.update', $this->taskStatus), $this->taskStatusData);

        $response->assertForbidden();
    }

    public function testUpdate(): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('task_statuses.update', $this->taskStatus), $this->taskStatusData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testDestroyNonAuth(): void
    {
        $response = $this->delete(route('task_statuses.destroy', $this->taskStatus));

        $response->assertForbidden();
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $this->taskStatus));

        $this->assertModelMissing($this->taskStatus);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }
}
