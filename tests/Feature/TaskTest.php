<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_index(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function test_create(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertForbidden();
    }

    public function test_store(): void
    {
        $response = $this->post(route('tasks.store'), [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'status_id' => fake()->randomDigit(),
            'created_by_id' => fake()->randomDigit(),
            'assigned_to_id' => fake()->randomDigit(),

        ]);

        $response->assertForbidden();
    }

    public function test_show(): void
    {
        $response = $this->get(route('tasks.show', fake()->randomDigit()));

        $response->assertOk();
    }

    public function test_edit(): void
    {
        $response = $this->get(route('tasks.edit', fake()->randomDigit()));

        $response->assertForbidden();
    }

    public function test_update(): void
    {
        $response = $this->put(route('tasks.store', fake()->randomDigit()), [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'status_id' => fake()->randomDigit(),
            'created_by_id' => fake()->randomDigit(),
            'assigned_to_id' => fake()->randomDigit(),

        ]);

        $response->assertForbidden();
    }

    public function test_destroy(): void
    {
        $response = $this->delete(route('tasks.destroy', fake()->randomDigit()));

        $response->assertForbidden();
    }
}
