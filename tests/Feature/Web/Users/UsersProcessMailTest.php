<?php

namespace Tests\Feature\Web\Users;

use App\Channels\EmailMailable;
use App\Events\Templates\Mails\ProcessUserEmailChangeEvent;
use App\Http\Livewire\UserForm;
use App\Listeners\TemplateListener;
use App\Models\Template;
use App\Models\User;
use App\Repositories\Contracts\TemplateRepositoryContract;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\Feature\Web\TestCase;
use function __;

class UsersProcessMailTest extends TestCase
{
    private User $appUser;
    private Template $mailTemplate;

    public function setUp(): void
    {
        parent::setUp();
        $this->appUser = User::factory()->create();
        $this->mailTemplate = app(TemplateRepositoryContract::class)
            ->findByEvent(ProcessUserEmailChangeEvent::class)
            ->first();
    }

    public function test_send_mail_user()
    {
        Event::fake([ProcessUserEmailChangeEvent::class]);
        Mail::fake();
        $this->actingAs($this->user);

        Livewire::test(UserForm::class, [
            'action' => 'updateUser',
            'user' => $this->appUser
        ])
            ->set('email', 'test@test.pl')
            ->call('updateUser')
            ->assertOk();
        $this->appUser->refresh();
        $this->assertTrue($this->appUser->email_from_process === 'test@test.pl');
        $this->assertTrue((bool)$this->appUser->process_email_expire_at);
        $this->assertTrue((bool)$this->appUser->process_token);
        Event::assertDispatched(ProcessUserEmailChangeEvent::class);

        $listener = app(TemplateListener::class);
        $listener->handle(new ProcessUserEmailChangeEvent($this->appUser));

        Mail::assertSent(EmailMailable::class, function (EmailMailable $mailable) {
            $this->assertEquals($this->mailTemplate->subject, $mailable->subject);
            $this->assertTrue($mailable->hasTo($this->appUser->email));

            return true;
        });
    }

    public function test_change_email_after_process()
    {
        Event::fake([ProcessUserEmailChangeEvent::class]);
        Mail::fake();
        $this->actingAs($this->user);

        Livewire::test(UserForm::class, [
            'action' => 'updateUser',
            'user' => $this->appUser
        ])
            ->set('email', 'test@test.pl')
            ->call('updateUser')
            ->assertOk();
        $this->appUser->refresh();
        $this->assertTrue($this->appUser->email_from_process === 'test@test.pl');
        $this->assertTrue((bool)$this->appUser->process_email_expire_at);
        $this->assertTrue((bool)$this->appUser->process_token);
        Event::assertDispatched(ProcessUserEmailChangeEvent::class);

        $listener = app(TemplateListener::class);
        $listener->handle(new ProcessUserEmailChangeEvent($this->appUser));

        Mail::assertSent(EmailMailable::class, function (EmailMailable $mailable) {
            $this->assertEquals($this->mailTemplate->subject, $mailable->subject);
            $this->assertTrue($mailable->hasTo($this->appUser->email));

            return true;
        });

        $this
            ->get(route('user.process.email', ['token' => $this->appUser->process_token]))
            ->assertRedirect(route('users.index'));
        $this->appUser->refresh();
        $this->assertTrue($this->appUser->email === $this->appUser->email_from_process);
        $this->assertTrue(!$this->appUser->process_email_expire_at);
        $this->assertTrue(!$this->appUser->process_token);
    }
}
