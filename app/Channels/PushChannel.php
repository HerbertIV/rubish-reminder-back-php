<?php

namespace App\Channels;

use App\Channels\Contracts\NotificationChannelContract;
use App\Enums\LimitEnums;
use App\Events\Templates\EventWrapper;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class PushChannel implements NotificationChannelContract
{
    public static function send(EventWrapper $event, array $sections): bool
    {
        $messaging = app('firebase.messaging');
        $message = CloudMessage::new()
            ->withNotification(Notification::create($sections['subject'] ?? '', $sections['content'] ?? ''));
        $to = [];
        $i = 0;
        foreach ($event->getReceivers() as $receiver) {
            if (isset($to[$i]) && count($to[$i]) >= LimitEnums::FIREBASE_LIMIT_TOKENS) {
                $i++;
            }
            $to[$i][] = $receiver->device_key;
        }

        foreach ($to as $item) {
            $result = $messaging->sendMulticast($message, $item);
            Log::debug('result push', [
                'errors' => $result->failures()->getItems(),
                'success' => $result->successes()->getItems()
            ]);
        }

        return true;
    }
}
