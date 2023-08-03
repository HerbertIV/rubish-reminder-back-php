<?php

namespace App\Listeners;

use App\Events\Templates\EventWrapper;
use App\Facades\Template;

class TemplateListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @return void
     */
    public function handle($event)
    {
        $eventWrapper = new EventWrapper($event);
        // we only want to handle User related events (probably?)
        Template::handleEvent($eventWrapper);
    }
}
