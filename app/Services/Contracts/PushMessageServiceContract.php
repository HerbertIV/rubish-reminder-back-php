<?php

namespace App\Services\Contracts;

interface PushMessageServiceContract
{
    public function sendPush(string $deviceKey, string $title, string $body): void;
}
