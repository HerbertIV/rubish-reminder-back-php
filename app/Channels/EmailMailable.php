<?php

namespace App\Channels;

use Illuminate\Mail\Mailable;

class EmailMailable extends Mailable
{
    public function getHtml(): ?string
    {
        return $this->html ?? null;
    }

    public function build()
    {
    }
}
