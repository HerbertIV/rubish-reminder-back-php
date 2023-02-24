<?php

namespace Tests\Feature\Web\Regions;

use App\Http\Livewire\RegionForm;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Livewire\Livewire;
use Tests\Feature\Web\TestCase;
use function __;
use function route;

class RegionsCreateTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_create_view()
    {
        $this
            ->actingAs($this->user)
            ->get(route('regions.create'))
            ->assertOk();

        $this->view('pages.region.create')
            ->assertSee(__('Create Region'))
            ->assertSee(__('Regions list'))
            ->assertSee(__('Name'))
            ->assertSee(__('Form to create or change Region record'))
        ;
    }

    public function test_unauthorized_create_view()
    {
        $this
            ->get(route('regions.create'))
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }

    public function test_success_create_region()
    {
        $region = Region::factory()->make()->toArray();
        $this
            ->actingAs($this->user)
            ->post(route('regions.store'), $region)
            ->assertCreated()
            ->assertJsonFragment(['success' => true]);
    }

    public function test_unauthorized_create_region()
    {
        $region = Region::factory()->make()->toArray();
        $this
            ->post(route('regions.store'), $region)
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }

    public function test_validated_inputs_create()
    {
        $this
            ->actingAs($this->user)
            ->post(route('regions.store'), ['name' => ''])
            ->assertSessionHasErrors(['name']);
    }

    public function test_livewire_create()
    {
        $this->actingAs($this->user);

        Livewire::test(RegionForm::class, ['action' => 'createRegion'])
            ->set('name', 'Region')
            ->call('createRegion')
            ->assertEmitted('saved');

    }

    public function test_validated_inputs_livewire_create()
    {
        $this->actingAs($this->user);

        Livewire::test(RegionForm::class, ['action' => 'createRegion'])
            ->call('createRegion')
            ->assertHasErrors(['name' => 'required']);

    }
}
