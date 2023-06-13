<?php

namespace Tests\Feature;

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

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->wrongUser = User::factory()->create();
        $this->taskStatus = TaskStatus::factory([
            'creator_id' => $this->user->id,
        ])->create();
    }

    public function test_index(): void
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertStatus(200);
    }

    public function test_create_non_auth(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertForbidden();
    }

    public function test_create(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function test_store_non_auth(): void
    {
        $response = $this->post(route('task_statuses.store'), [
            'name' => fake()->name(),
        ]);

        $response->assertForbidden();
    }

    public function test_store(): void
    {
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), [
            'name' => fake()->name(),
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function test_edit_non_auth(): void
    {
        $response = $this->get(route('task_statuses.edit', $this->taskStatus->id));
        $response->assertForbidden();
    }

    public function test_edit_by_wrong_user(): void
    {
        $response = $this->actingAs($this->wrongUser)->get(route('task_statuses.edit', $this->taskStatus->id));
        $response->assertForbidden();
    }

    public function test_edit(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $this->taskStatus->id));
        $response->assertOk();
    }

    public function test_update_non_auth(): void
    {
        $response = $this->put(route('task_statuses.update', $this->taskStatus->id), [
            'name' => fake()->name(),
        ]);

        $response->assertForbidden();
    }

    public function test_update_by_wrong_user(): void
    {
        $response = $this->actingAs($this->wrongUser)->put(route('task_statuses.update', $this->taskStatus->id), [
            'name' => fake()->name(),
        ]);
        $response->assertForbidden();
    }

    public function test_update(): void
    {
        $response = $this->actingAs($this->user)->put(route('task_statuses.update', $this->taskStatus->id), [
            'name' => fake()->name(),
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function test_destroy_non_auth(): void
    {
        $response = $this->delete(route('task_statuses.destroy', $this->taskStatus->id));
        $response->assertForbidden();
    }

    public function test_destroy_by_wrong_user(): void
    {
        $response = $this->actingAs($this->wrongUser)->delete(route('task_statuses.destroy', $this->taskStatus->id));
        $response->assertForbidden();
    }

    public function test_destroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $this->taskStatus->id));
        $this->assertModelMissing($this->taskStatus);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
    }
}
