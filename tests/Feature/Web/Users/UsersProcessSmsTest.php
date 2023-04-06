<?php

namespace Tests\Feature\Web\Users;

use App\Channels\EmailMailable;
use App\Events\Templates\Mails\ProcessUserEmailChangeEvent;
use App\Events\Templates\Mails\ProcessUserPhoneChangeEmailSendEvent;
use App\Events\Templates\Sms\ProcessUserPhoneChangeEvent;
use App\Http\Livewire\UserForm;
use App\Http\Livewire\UserPhoneProcessForm;
use App\Listeners\TemplateListener;
use App\Models\Template;
use App\Models\User;
use App\Repositories\Contracts\TemplateRepositoryContract;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\Feature\Web\TestCase;
use function __;

class UsersProcessSmsTest extends TestCase
{
    private User $appUser;
    private Template $mailTemplate;

    public function setUp(): void
    {
        parent::setUp();
        $this->appUser = User::factory()->create();
        $this->mailTemplate = app(TemplateRepositoryContract::class)
            ->findByEvent(ProcessUserPhoneChangeEvent::class)
            ->first();
    }

    public function test_send_sms_user()
    {
        Event::fake([ProcessUserPhoneChangeEvent::class]);
        Mail::fake();
        $this->actingAs($this->user);

        Livewire::test(UserForm::class, [
            'action' => 'updateUser',
            'user' => $this->appUser
        ])
            ->set('phone', '123456789')
            ->call('updateUser')
            ->assertOk();
        $this->appUser->refresh();
        $this->assertTrue($this->appUser->phone_from_process === '123456789');
        $this->assertTrue((bool)$this->appUser->process_phone_expire_at);
        Event::assertDispatched(ProcessUserPhoneChangeEvent::class);


    }

    public function test_change_email_after_process()
    {
        Event::fake([
            ProcessUserPhoneChangeEvent::class,
            ProcessUserPhoneChangeEmailSendEvent::class
        ]);
        Mail::fake();
        $this->actingAs($this->user);

        Livewire::test(UserForm::class, [
            'action' => 'updateUser',
            'user' => $this->appUser
        ])
            ->set('phone', '123456789')
            ->call('updateUser')
            ->assertOk();
        $this->appUser->refresh();
        $this->assertTrue($this->appUser->phone_from_process === '123456789');
        $this->assertTrue((bool)$this->appUser->process_phone_expire_at);
        Event::assertDispatched(ProcessUserPhoneChangeEvent::class);
        Event::assertDispatched(ProcessUserPhoneChangeEmailSendEvent::class);

        $listener = app(TemplateListener::class);
        $listener->handle(new ProcessUserPhoneChangeEmailSendEvent($this->appUser));

        Mail::assertSent(EmailMailable::class, function (EmailMailable $mailable) {
            $this->assertEquals($this->mailTemplate->subject, $mailable->subject);
            $this->assertTrue($mailable->hasTo($this->appUser->email));

            return true;
        });

        $this
            ->get(route('user.process.phone', ['token' => $this->appUser->process_token]))
            ->assertOk();
        Livewire::test(UserPhoneProcessForm::class, [
            'action' => 'userPhoneProcessVerify',
            'token' => $this->appUser->process_token
        ])
            ->set('smsCode', $this->appUser->sms_code)
            ->call('userPhoneProcessVerify')
            ->assertOk();
        $this->appUser->refresh();
        $this->assertTrue($this->appUser->phone === $this->appUser->phone_from_process);
        $this->assertTrue(!$this->appUser->process_email_expire_at);
        $this->assertTrue(!$this->appUser->process_token);
        $this->assertTrue(!$this->appUser->sms_code);
    }
}
