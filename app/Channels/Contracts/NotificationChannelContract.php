<?php

namespace App\Channels\Contracts;

use App\Events\Templates\EventWrapper;

interface NotificationChannelContract
{
    public static function send(EventWrapper $event, array $sections): bool;
}
