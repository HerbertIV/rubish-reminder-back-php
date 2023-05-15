<?php

namespace App\Observers;

use App\Events\Templates\Mails\ProcessUserEmailChangeEvent;
use App\Events\Templates\Mails\ProcessUserPhoneChangeEmailSendEvent;
use App\Events\Templates\Sms\ProcessUserPhoneChangeEvent;
use App\Models\User;

class UserObserver
{
    public function saved(User $user): void
    {
        if (
            $user->email &&
            $user->getOriginal('email_from_process') !== $user->email_from_process &&
            $user->getOriginal('process_email_expire_at') !== $user->process_email_expire_at &&
            $user->process_email_expire_at > now()
        ) {
            event(new ProcessUserEmailChangeEvent($user));
        }
        if (
            $user->phone &&
            $user->getOriginal('phone_from_process') !== $user->phone_from_process &&
            $user->getOriginal('process_phone_expire_at') !== $user->process_phone_expire_at &&
            $user->process_phone_expire_at > now()
        ) {
            event(new ProcessUserPhoneChangeEvent($user));
            event(new ProcessUserPhoneChangeEmailSendEvent($user));
        }
    }
}
