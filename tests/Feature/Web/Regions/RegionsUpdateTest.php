<?php

namespace Tests\Feature\Web\Regions;

use App\Http\Livewire\RegionForm;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Livewire\Livewire;
use Tests\Feature\Web\TestCase;
use function __;
use function route;

class RegionsUpdateTest extends TestCase
{
    private Region $region;

    public function setUp(): void
    {
        parent::setUp();
        $this->region = Region::factory()->create();
    }

    public function test_update_view()
    {
        $this
            ->actingAs($this->user)
            ->get(route('regions.edit', $this->region))
            ->assertOk();

        $this->view('pages.region.edit', ['region' => $this->region])
            ->assertSee(__('Edit Region'))
            ->assertSee(__('Regions list'))
            ->assertSee(__('Name'))
            ->assertSee(__('Form to create or change Region record'))
        ;
    }

    public function test_unauthorized_update_view()
    {
        $this
            ->get(route('regions.edit', $this->region))
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }

    public function test_success_update_region()
    {
        $region = Region::factory()->make()->toArray();
        $this->assertTrue($this->region->name !== $region['name']);
        $this
            ->actingAs($this->user)
            ->put(route('regions.update', $this->region), $region)
            ->assertOk()
            ->assertJsonFragment(['success' => true]);
        $this->region->refresh();
        $this->assertTrue($this->region->name === $region['name']);
    }

    public function test_unauthorized_update_region()
    {
        $region = Region::factory()->make()->toArray();
        $this
            ->put(route('regions.update', $this->region), $region)
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }

    public function test_validated_inputs_update()
    {
        $this
            ->actingAs($this->user)
            ->put(route('regions.update', $this->region), ['name' => ''])
            ->assertSessionHasErrors(['name']);
    }

    public function test_livewire_update()
    {
        $this->actingAs($this->user);

        Livewire::test(RegionForm::class, [
            'action' => 'updateRegion',
            'region' => $this->region
        ])
            ->set('name', 'Region')
            ->call('updateRegion')
            ->assertEmitted('saved');
        $this->region->refresh();
        $this->assertTrue($this->region->name === 'Region');
    }

    public function test_validated_inputs_livewire_update()
    {
        $this->actingAs($this->user);

        Livewire::test(RegionForm::class, [
            'action' => 'updateRegion',
            'region' => $this->region
        ])
            ->set('name', '')
            ->call('updateRegion')
            ->assertHasErrors(['name' => 'required']);

    }
}
