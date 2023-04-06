<?php

namespace App\Libs\Twilio;

use Twilio\Rest\Client;

abstract class Twilio
{
    protected Client $client;

    public function __construct()
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');

        $this->client = new Client($accountSid, $authToken);
    }
}
