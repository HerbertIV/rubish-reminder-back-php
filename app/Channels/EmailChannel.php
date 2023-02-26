<?php

namespace App\Channels;

use App\Events\Templates\EventWrapper;
use Illuminate\Support\Facades\Mail;

class EmailChannel
{
    public static function send(EventWrapper $event, array $sections): bool
    {
        $mailable = new EmailMailable();
        $mailable->from($sections['mail_from']);
        $mailable->to($event->user()->email);
        $mailable->subject($sections['subject']);
        $mailable->html($sections['content']);
        Mail::send($mailable);

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
