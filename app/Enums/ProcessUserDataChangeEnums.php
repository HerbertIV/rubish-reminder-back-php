<?php

declare(strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

class ProcessUserDataChangeEnums extends Enum
{
    // During process from now to now + x minutes
    public const PROCESS_EMAIL_CHANGE_ACTIVE = 15;

    // During process from now to now + x minutes
    public const PROCESS_PHONE_CHANGE_ACTIVE = 15;
}
