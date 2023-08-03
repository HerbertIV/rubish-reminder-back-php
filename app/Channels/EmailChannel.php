<?php

namespace App\Channels;

use App\Channels\Contracts\NotificationChannelContract;
use App\Events\Templates\EventWrapper;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailChannel implements NotificationChannelContract
{
    public static function send(EventWrapper $event, array $sections): bool
    {
        try {
            $mailable = new EmailMailable();
            $mailable->from($sections['mail_from']);
            $to = [];
            foreach ($event->getReceivers() as $receiver) {
                $to[] = $receiver->email;
            }
            $mailable->to($to);
            $mailable->subject($sections['subject']);
            $mailable->html($sections['content']);
            Mail::send($mailable);
            Log::channel('email')->info('Mail send', $sections);
        } catch (Exception $exception) {
            Log::channel('email')->error('Mail not send', $sections);
            Log::error('Mail not send', [
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
            ]);
        }
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
