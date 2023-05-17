<?php

namespace App\Enums;

use App\Events\Templates\Mails\ProcessUserEmailChangeEvent;
use App\Events\Templates\Mails\ProcessUserPhoneChangeEmailSendEvent;
use App\Events\Templates\Sms\ProcessUserPhoneChangeEvent;
use App\Events\Templates\Sms\SmsReminderEventEvent;
use BenSampo\Enum\Enum;

class TemplateEnums extends Enum
{
    public const TEMPLATE_EVENTS_TO_LIST = [
        ProcessUserEmailChangeEvent::class => 'Proces zmiany adresu email.',
        ProcessUserPhoneChangeEvent::class => 'Proces zmiany numeru telefonu.',
        ProcessUserPhoneChangeEmailSendEvent::class => 'Rozpoczęcie procesu zmiany numeru telefonu.',
        SmsReminderEventEvent::class => 'Przypomnienie o odbiorze śmieci.'
    ];
}
