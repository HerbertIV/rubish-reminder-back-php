<?php

namespace App\Services\Contracts;

use App\Events\Templates\EventWrapper;
use App\Models\Template;

interface TemplateEventServiceContract
{
    public function sendFakeMail(
        string $eventClass,
        ?Template $template,
        ?string $email = ''
    ): void;
    public function register(string $eventClass, string $variableClass): void;
    public function getVariableClassName(string $eventClass, string $channelClass): ?string;
    public function getRegisteredEvents(): array;
    public function handleEvent(EventWrapper $event): void;
}
