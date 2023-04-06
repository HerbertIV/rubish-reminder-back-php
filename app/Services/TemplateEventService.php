<?php

namespace App\Services;

use App\Channels\Contracts\NotificationChannelContract;
use App\Channels\EmailChannel;
use App\Channels\SmsChannel;
use App\Events\Templates\EventWrapper;
use App\Helpers\StringHelper;
use App\Models\Template;
use App\Repositories\Contracts\TemplateRepositoryContract;
use App\Services\Contracts\TemplateEventServiceContract;
use Illuminate\Support\Facades\Log;

class TemplateEventService implements TemplateEventServiceContract
{
    protected array $events = [];

    public function register(string $eventClass, string $variableClass, string $channel): void
    {
        if (! array_key_exists($eventClass, $this->events)) {
            $this->events[$eventClass][$channel] = $variableClass;
        }
    }

    public function getVariableClassName(string $eventClass, string $channelClass): ?string
    {
        return $this->events[$eventClass][$channelClass] ?? null;
    }

    public function getRegisteredEvents(): array
    {
        return $this->events;
    }

    public function handleEvent(EventWrapper $event): void
    {
        if (! array_key_exists($event->eventClass(), $this->events)) {
            return;
        }
        //TODO add sms twilio send process
        $variableClass = reset($this->events[$event->eventClass()]);
        $template = $this->getTemplateForEvent($event, $variableClass);
        if (! $template) {
            Log::error(
                __('Template not found when handling registered Event'),
                [
                    'event' => $event->eventClass(),
                    'channel' => EmailChannel::class,
                    'variables' => $variableClass,
                ]
            );
            abort(404, __('Template not found when handling registered Event'));
        }
        $variables = $variableClass::variablesFromEvent($event);
        $sections = $this->generateContent($template, $variables);
        if (
            is_a(key($this->events[$event->eventClass()]), NotificationChannelContract::class, true)
        ) {
            key($this->events[$event->eventClass()])::send($event, $sections);
        }
    }

    public function __construct(
        private TemplateRepositoryContract $templateRepository
    ) {
    }

    public function sendFakeMail(
        string $eventClass,
        ?Template $template,
        ?string $email = ''
    ): void {
        $variableClass = $this->events[$eventClass];
        if (! $template) {
            Log::error(
                __('Template not found when handling registered Event'),
                [
                    'event' => $eventClass,
                    'channel' => EmailChannel::class,
                    'variables' => $variableClass,
                ]
            );
            abort(404, __('Template not found when handling registered Event'));
        }
        $variables = $variableClass::mockedVariables();
        $sections = $this->generateContent($template, $variables);
        EmailChannel::sendFakeMail($email, $sections);
    }

    protected function getTemplateForEvent(EventWrapper $event, string $variableClass): ?Template
    {
        $template = null;
        if ($variableClass::assignableClass()) {
            $template = $this->templateRepository->where(['event_name' => $event->eventClass()])->first();
        }

        return $template;
    }

    private function generateContent(Template $template, array $variables): array
    {
        $result['content'] = StringHelper::replacePattern($template->content, $variables);
        $result['subject'] = $template->subject;
        $result['mail_from'] = $mailTemplate->mail_from ?? env('MAIL_FROM_ADDRESS', 'admin@example.com');

        return $result;
    }
}
