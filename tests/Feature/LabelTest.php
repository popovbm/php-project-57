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
    private Label $label;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->label = Label::factory()->create();
        $this->newLabelData = Label::factory()
            ->make()
            ->only([
                'name',
                'description',
            ]);
        $this->updateLabelData = Label::factory()
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

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this->actingAs($this->user)->post(route('labels.store'), $this->newLabelData);

        $this->assertDatabaseHas('labels', $this->newLabelData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.edit', $this->label));

        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('labels.update', $this->label), $this->updateLabelData);

        $this->assertDatabaseHas('labels', $this->updateLabelData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $this->label));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing('labels', $this->label->only('id'));
    }
}
