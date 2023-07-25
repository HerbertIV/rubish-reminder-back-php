<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class ReceiverTypes extends Enum
{
    public const SMS = 'sms';
    public const PUSH = 'push';
    public const EMAIL = 'email';
}
