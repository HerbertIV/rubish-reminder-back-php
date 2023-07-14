<?php

namespace App\Services;

use App\Services\Contracts\PushMessageServiceContract;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class PushMessageService implements PushMessageServiceContract
{
    public function sendPush(string $deviceKey, string $title, string $body): void
    {
        $messaging = app('firebase.messaging');
        $message = CloudMessage::new()
            ->withNotification(Notification::create($title, $body));

        $result = $messaging->sendMulticast($message, [$deviceKey]);

        \Log::debug('result push', [
            'errors' => $result->failures()->getItems(),
            'success' => $result->successes()->getItems()
        ]);
    }
}
