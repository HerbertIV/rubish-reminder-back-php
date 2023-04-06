<?php

namespace App\Facades;

use App\Events\Templates\EventWrapper;
use App\Services\Contracts\TemplateEventServiceContract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static            void register(string $eventClass, string $variableClass, string $channel)
 * @method static            void handleEvent(EventWrapper $event)
 * @method static         ?string getVariableClassName(string $eventClass, string $channelClass)
 * @method static           array getRegisteredEvents()
 * @method static           array getRegisteredChannels()
 * @method static           array getRegisteredEventsWithTokens()
 * @method static            void createDefaultTemplatesForChannel(string $channelClass)
 *
 * @see \App\Services\TemplateEventService
 */
class Template extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return TemplateEventServiceContract::class;
    }
}
