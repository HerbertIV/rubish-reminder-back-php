<?php

namespace Tests\Feature\Web\Regions;

use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Tests\Feature\Web\TestCase;
use function route;

class RegionsDeleteTest extends TestCase
{
    private Region $region;

    public function setUp(): void
    {
        parent::setUp();
        $this->region = Region::factory()->create();
    }

    public function test_success_delete_region()
    {
        $this
            ->actingAs($this->user)
            ->delete(route('regions.destroy', $this->region))
            ->assertOk();
    }

    public function test_unauthorized_delete_region()
    {
        $this
            ->delete(route('regions.destroy', $this->region))
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }
}
