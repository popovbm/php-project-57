<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\Fake;
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
        $this->label = Label::factory([
            'created_by_id' => $this->user
        ])->create();
        $this->labelData = Label::factory([
            'name' => fake()->unique()->name(),
            'description' => fake()->text(100),
        ])
            ->make()
            ->only([
                'name',
                'description',
            ]);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertOk();
    }

    public function testCreateNonAuth(): void
    {
        $response = $this->get(route('labels.create'));

        $response->assertForbidden();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));

        $response->assertOk();
    }

    public function testStoreNonAuth(): void
    {
        $response = $this->post(route('labels.store'), $this->labelData);

        $response->assertForbidden();
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('labels.store'), $this->labelData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testEditNonAuth(): void
    {
        $response = $this->get(route('labels.edit', $this->label));

        $response->assertForbidden();
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.edit', $this->label));

        $response->assertOk();
    }

    public function testUpdateNonAuth(): void
    {
        $response = $this->patch(route('labels.update', $this->label), $this->labelData);

        $response->assertForbidden();
    }

    public function testUpdate(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('labels.update', $this->label), $this->labelData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testDestroyNonAuth(): void
    {
        $response = $this->delete(route('labels.destroy', $this->label));

        $response->assertForbidden();
    }

    public function testDestroyByWrongUser(): void
    {
        $response = $this->actingAs($this->wrongUser)->delete(route('labels.destroy', $this->label));

        $response->assertForbidden();
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $this->label));

        $this->assertModelMissing($this->label);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }
}
