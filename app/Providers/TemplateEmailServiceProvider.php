<?php

namespace App\Providers;

use App\Channels\EmailChannel;
use App\Channels\SmsChannel;
use App\Events\Templates\Mails\ProcessUserEmailChangeEvent;
use App\Events\Templates\Sms\ProcessUserPhoneChangeEvent;
use App\Facades\Template;
use App\Variables\Mails\ProcessUserEmailChangeVariable;
use App\Variables\Sms\ProcessUserPhoneChangeVariable;
use Illuminate\Support\ServiceProvider;

class TemplateEmailServiceProvider extends ServiceProvider
{
    public function register()
    {
        Template::register(
            ProcessUserEmailChangeEvent::class,
            ProcessUserEmailChangeVariable::class,
            EmailChannel::class
        );
        Template::register(
            ProcessUserPhoneChangeEvent::class,
            ProcessUserPhoneChangeVariable::class,
            SmsChannel::class
        );
    }
}
