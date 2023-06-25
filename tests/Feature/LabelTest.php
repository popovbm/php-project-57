<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;
    private User $wrongUser;
    private Label $label;
    private array $labelData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->wrongUser = User::factory()->create();
        $this->label = Label::factory(['created_by_id' => $this->user->id])->create();
        $this->labelData = Label::factory()->make()->only([
            'name',
            'description',
        ]);
    }

    public function test_index(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertOk();
    }

    public function test_create_non_auth(): void
    {
        $response = $this->get(route('labels.create'));

        $response->assertForbidden();
    }

    public function test_create(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));

        $response->assertOk();
    }

    public function test_store_non_auth(): void
    {
        $response = $this->post(route('labels.store'), $this->labelData);

        $response->assertForbidden();
    }

    public function test_store(): void
    {
        $response = $this->actingAs($this->user)->post(route('labels.store'), $this->labelData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function test_edit_non_auth(): void
    {
        $response = $this->get(route('labels.edit', $this->label));

        $response->assertForbidden();
    }

    public function test_edit(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.edit', $this->label));

        $response->assertOk();
    }

    public function test_update_non_auth(): void
    {
        $response = $this->patch(route('labels.update', $this->label), $this->labelData);

        $response->assertForbidden();
    }

    public function test_update(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('labels.update', $this->label), $this->labelData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function test_destroy_non_auth(): void
    {
        $response = $this->delete(route('labels.destroy', $this->label));

        $response->assertForbidden();
    }

    public function test_destroy_by_wrong_user(): void
    {
        $response = $this->actingAs($this->wrongUser)->delete(route('labels.destroy', $this->label));

        $response->assertForbidden();
    }

    public function test_destroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $this->label));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }
}
