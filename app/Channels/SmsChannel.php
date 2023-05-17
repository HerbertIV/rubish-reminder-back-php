<?php

namespace App\Channels;

use App\Channels\Contracts\NotificationChannelContract;
use App\Events\Templates\EventWrapper;
use App\Libs\Twilio\Sms;
use Illuminate\Support\Facades\Log;

class SmsChannel implements NotificationChannelContract
{
    public static function send(EventWrapper $event, array $sections): bool
    {
        Log::channel('sms')->debug('sms content', [
            'to_phone' => $event->user()->phone,
            'content' => $sections['content']
        ]);
        // TODO After tests uncomment and remove log
//        $sms = new Sms();
//        $sms->send($event->user()->phone, $sections['content']);
        return true;
    }
}
