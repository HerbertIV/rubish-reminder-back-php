<?php

namespace Tests\Feature\Web\Users;

use App\Events\Templates\Mails\ProcessUserEmailChangeEvent;
use App\Events\Templates\Sms\ProcessUserPhoneChangeEvent;
use App\Http\Livewire\UserForm;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\Feature\Web\TestCase;
use function __;
use function route;

class UsersUpdateTest extends TestCase
{
    private User $appUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->appUser = User::factory()->create();
    }

    public function test_update_view()
    {
        $this
            ->actingAs($this->user)
            ->get(route('users.edit', $this->appUser))
            ->assertOk();

        $this->view('pages.user.edit', ['user' => $this->appUser])
            ->assertSee(__('Edit User'))
            ->assertSee(__('First name'))
            ->assertSee(__('Last name'))
            ->assertSee(__('Email'))
            ->assertSee(__('Phone'))
            ->assertSee(__('Active'))
            ->assertSee(__('Form to create or change User record'))
        ;
    }

    public function test_unauthorized_update_view()
    {
        $this
            ->get(route('users.edit', $this->appUser))
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }

    public function test_success_update_user()
    {
        Event::fake();
        $user = User::factory()->make()->toArray();
        $this->assertTrue($this->appUser->first_name !== $user['first_name']);
        $this->assertTrue($this->appUser->last_name !== $user['last_name']);
        $this->assertTrue($this->appUser->phone !== $user['phone']);
        $this->assertTrue($this->appUser->email !== $user['email']);

        $this
            ->actingAs($this->user)
            ->put(route('users.update', $this->appUser), $user)
            ->assertOk()
            ->assertJsonFragment(['success' => true]);
        $this->appUser->refresh();
        $this->assertTrue($this->appUser->first_name === $user['first_name']);
        $this->assertTrue($this->appUser->last_name === $user['last_name']);
        $this->assertTrue($this->appUser->phone !== $user['phone']);
        $this->assertTrue($this->appUser->email !== $user['email']);

        Event::assertDispatched(ProcessUserEmailChangeEvent::class);
        Event::assertDispatched(ProcessUserPhoneChangeEvent::class);
    }

    public function test_unauthorized_update_user()
    {
        $user = User::factory()->make()->toArray();
        $this
            ->put(route('users.update', $this->user), $user)
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route('login'));
    }

    public function test_validated_inputs_update()
    {
        $this
            ->actingAs($this->user)
            ->put(route('users.update', $this->user), ['email' => ''])
            ->assertSessionHasErrors(['email']);
        $this
            ->actingAs($this->user)
            ->put(route('users.update', $this->user), ['email' => 'aaaa'])
            ->assertSessionHasErrors(['email']);
    }

    public function test_livewire_update()
    {
        $this->actingAs($this->user);

        Livewire::test(UserForm::class, [
            'action' => 'updateUser',
            'user' => $this->appUser
        ])
            ->set('email', 'test@example.com')
            ->set('phone', '123123132')
            ->set('firstName', 'Test')
            ->set('lastName', 'Test2')
            ->set('active', 1)
            ->call('updateUser')
            ->assertEmitted('updated');
        $this->appUser->refresh();
        $this->assertTrue($this->appUser->first_name === 'Test');
        $this->assertTrue($this->appUser->last_name === 'Test2');
        $this->assertTrue($this->appUser->phone !== '123123132');
        $this->assertTrue($this->appUser->email !== 'test@example.com');

        Event::assertDispatched(ProcessUserEmailChangeEvent::class);
        Event::assertDispatched(ProcessUserPhoneChangeEvent::class);
    }

    public function test_validated_inputs_livewire_update()
    {
        $this->actingAs($this->user);

        Livewire::test(UserForm::class, [
            'action' => 'updateUser',
            'user' => $this->appUser
        ])
            ->set('email', 'test')
            ->call('updateUser')
            ->assertHasErrors(['email' => 'email']);

        Livewire::test(UserForm::class, [
            'action' => 'updateUser',
            'user' => $this->appUser
        ])
            ->set('email', '')
            ->call('updateUser')
            ->assertHasErrors(['email' => 'required']);
    }
}
