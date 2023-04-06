<?php

namespace App\Libs\Twilio;

use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\TwilioException;

class Sms extends Twilio
{
    public function send(string $to, string $message)
    {
        try {
            $this->client->messages->create(
                $to,
                [
                    'body' => $message,
                    'from' => env('TWILIO_NUMBER')
                ]
            );
            Log::channel('sms')->info('Message sent to ' . $to);
        } catch (TwilioException $e) {
            Log::error(
                'Could not send SMS notification.' .
                ' Twilio replied with: ' . $e
            );
        }
    }
}
