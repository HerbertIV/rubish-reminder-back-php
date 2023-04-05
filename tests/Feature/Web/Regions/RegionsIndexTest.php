<?php

namespace Tests\Feature\Web\Regions;

use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Tests\Feature\Web\TestCase;
use function __;
use function route;

class RegionsIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Region::factory(10)->create();
    }

    public function test_index_view()
    {
        $this
            ->actingAs($this->admin)
            ->get(route('regions.index'))
            ->assertOk();

        $this->view('pages.region.index')
            ->assertSee(__('Regions'))
            ->assertSee(__('Create'))
            ->assertSee(__('ID'))
            ->assertSee(__('Parent'))
            ->assertSee(__('Name'))
            ->assertSee(__('Actions'))
        ;
    }

    public function test_unauthorized_index_view()
    {
        $this
            ->get(route('regions.index'))
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }
}
