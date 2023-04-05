<?php

namespace App\Enums;

use App\Events\Templates\Mails\ProcessUserEmailChangeEvent;
use App\Events\Templates\Sms\ProcessUserPhoneChangeEvent;
use BenSampo\Enum\Enum;

class TemplateEnums extends Enum
{
    public const TEMPLATE_EVENTS_TO_LIST = [
        ProcessUserEmailChangeEvent::class => 'Process changing email for user',
        ProcessUserPhoneChangeEvent::class => 'Process changing phone for user',
    ];
}
