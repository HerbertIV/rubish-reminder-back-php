<?php

namespace App\Dtos;

class TemplateDto extends BaseDto
{
    protected string $eventName;
    protected string $subject;
    protected string $content;

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function toArray(): array
    {
        return [
            'event_name' => $this->getEventName(),
            'subject' => $this->getSubject(),
            'content' => $this->getContent(),
        ];
    }

    protected function setEventName(string $eventName): void
    {
        $this->eventName = $eventName;
    }

    protected function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    protected function setContent(string $content): void
    {
        $this->content = $content;
    }
}
