<?php

namespace App\Channels;

use App\Events\Templates\EventWrapper;
use App\Libs\Twilio\Sms;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SmsChannel
{
    public static function send(EventWrapper $event, array $sections): bool
    {
        $sms = new Sms();
        $sms->send($event->user()->phone, $sections['content']);
        return true;
    }

    public static function sendFakeMail(string $email, array $sections): bool
    {
        $mailable = new EmailMailable();
        $mailable->from($sections['mail_from']);
        $mailable->to($email);
        $mailable->subject($sections['subject']);
        $mailable->markdown('vendor.mail.html.message', [
            'header' => $sections['header'],
            'body' => $sections['content'],
            'footer' => $sections['footer'],
        ]);
        Mail::send($mailable);

        return true;
    }
}
