<?php

namespace Tests\Feature\Web\Users;

use App\Http\Livewire\RegionForm;
use App\Http\Livewire\UserForm;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Livewire\Livewire;
use Tests\Feature\Web\TestCase;
use function __;
use function route;

class UsersCreateTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_create_view()
    {
        $this
            ->actingAs($this->admin)
            ->get(route('users.create'))
            ->assertOk();
        $this->view('pages.user.create')
            ->assertSee(__('Create User'))
            ->assertSee(__('First name'))
            ->assertSee(__('Last name'))
            ->assertSee(__('Email'))
            ->assertSee(__('Phone'))
            ->assertSee(__('Active'))
            ->assertSee(__('Form to create or change User record'))
        ;
    }

    public function test_unauthorized_create_view()
    {
        $this
            ->get(route('users.create'))
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }

    public function test_success_create_user()
    {
        $user = User::factory()->make()->toArray();
        $this
            ->actingAs($this->user)
            ->post(route('users.store'), $user)
            ->assertCreated()
            ->assertJsonFragment(['success' => true]);
    }

    public function test_unauthorized_create_user()
    {
        $user = User::factory()->make()->toArray();
        $this
            ->post(route('users.store'), $user)
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }

    public function test_validated_inputs_create()
    {
        $this
            ->actingAs($this->user)
            ->post(route('users.store'), [
                'email' => ''
            ])
            ->assertSessionHasErrors(['email']);
        $this
            ->actingAs($this->user)
            ->post(route('users.store'), [
                'email' => 'aaa'
            ])
            ->assertSessionHasErrors(['email']);
        $this
            ->actingAs($this->user)
            ->post(route('users.store'), [
                'active' => 20
            ])
            ->assertSessionHasErrors(['active']);
    }

    public function test_livewire_create()
    {
        $this->actingAs($this->user);

        Livewire::test(UserForm::class, ['action' => 'createUser'])
            ->set('email', 'user@example.com')
            ->set('firstName', 'User')
            ->set('lastName', 'Example')
            ->set('phone', '123123123')
            ->set('active', 1)
            ->call('createUser')
            ->assertEmitted('saved');

    }

    public function test_validated_inputs_livewire_create()
    {
        $this->actingAs($this->user);

        Livewire::test(UserForm::class, ['action' => 'createUser'])
            ->call('createUser')
            ->assertHasErrors(['email' => 'required']);
        Livewire::test(UserForm::class, ['action' => 'createUser'])
            ->set('email', 'aaa')
            ->call('createUser')
            ->assertHasErrors(['email' => 'email']);
    }
}
