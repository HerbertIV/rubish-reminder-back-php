<?php

namespace Tests\Feature\Web\Users;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Tests\Feature\Web\TestCase;
use function route;

class UsersDeleteTest extends TestCase
{
    private User $appUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->appUser = User::factory()->create();
    }

    public function test_success_delete_user()
    {
        $this
            ->actingAs($this->user)
            ->delete(route('users.destroy', $this->appUser))
            ->assertOk();
    }

    public function test_unauthorized_delete_user()
    {
        $this
            ->delete(route('users.destroy', $this->appUser))
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }
}
