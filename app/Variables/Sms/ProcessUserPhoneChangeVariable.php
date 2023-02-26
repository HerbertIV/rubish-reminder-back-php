<?php

namespace App\Variables\Sms;

use App\Models\User;

class ProcessUserPhoneChangeVariable extends SmsVariables
{
    public static function assignableClass(): ?string
    {
        return User::class;
    }
}
