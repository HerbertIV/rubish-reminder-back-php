<?php

namespace Tests\Feature\Web\Users;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Tests\Feature\Web\TestCase;
use function __;
use function route;

class UsersIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        User::factory(10)->create();
    }

    public function test_index_view()
    {
        $this
            ->actingAs($this->admin)
            ->get(route('users.index'))
            ->assertOk();

        $this->view('pages.user.index')
            ->assertSee(__('Users'))
            ->assertSee(__('Create'))
            ->assertSee(__('ID'))
            ->assertSee(__('First name'))
            ->assertSee(__('Last name'))
            ->assertSee(__('Email'))
            ->assertSee(__('Phone'))
            ->assertSee(__('Active'))
            ->assertSee(__('Actions'))
        ;
    }

    public function test_unauthorized_index_view()
    {
        $this
            ->get(route('users.index'))
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }
}
