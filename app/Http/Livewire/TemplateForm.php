<?php

declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Dtos\RegionDto;
use App\Dtos\TemplateDto;
use App\Http\Requests\RegionRequest;
use App\Http\Requests\TemplateRequest;
use App\Http\Resources\AsyncResource;
use App\Models\Region;
use App\Models\Template;
use App\Services\Contracts\RegionServiceContract;
use App\Services\Contracts\TemplateServiceContract;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class TemplateForm extends Component
{
    private TemplateServiceContract $templateService;
    public ?string $eventName = '';
    public ?string $content = '';
    public ?string $subject = '';
    public Template $template;
    public string $action;
    public array $button;

    public function __construct($id = null)
    {
        $this->templateService = app(TemplateServiceContract::class);
        parent::__construct($id);
    }

    protected $listeners = [
        'selectedCompanyItem',
        'TemplateCreateEvent'
    ];

    public function selectedCompanyItem($name, $item)
    {
        $this->$name = (int)$item;
    }

    protected function getRules()
    {
        return (new TemplateRequest)->rules();
    }

    public function createTemplate(): void
    {
        $this->resetErrorBag();
        $this->validate();

        $templateDto = new TemplateDto($this->toArray());
        $template = $this->templateService->create($templateDto);

        $this->emit('saved');
        $this->redirect(route('templates.show', $template));
    }

    public function updateTemplate(): void
    {
        $this->resetErrorBag();
        $this->validate();
        $template = $this->template;
        $templateDto = new TemplateDto($this->toArray());
        $this->templateService->update($templateDto, $template->getKey());
        $this->emit('updated');
        $this->redirect(route('templates.show', $template));
    }

    public function mount(?Template $template = null): void
    {
        if ($template) {
            $this->template = $template;
            $this->setData([
                'content' => $this->template->content,
                'subject' => $this->template->subject,
                'eventName' => $this->template->event_name,
            ]);
        }
        $this->button = create_button($this->action, 'Template');
    }

    public function render(): View
    {
        return view('pages.template.components.template-form');
    }

    public function getEventNameSelect2Format(): ?array
    {
        if ($this->eventName) {
            return AsyncResource::make(
                $this->templateService->where('event_name', '=', $this->eventName)->first()
            )->resolve();
        }
        return null;
    }

    public function toArray(): array
    {
        return [
            'event_name' => $this->eventName,
            'content' => $this->content,
            'subject' => $this->subject,
        ];
    }

    public function setData(array $data): void
    {
        foreach ($data as $k => $v) {
            $key = Str::studly($k);
            if (method_exists($this, 'set' . $key)) {
                $this->{'set' . $key}($v);
            } else {
                $key = lcfirst($key);
                if (array_key_exists($key, get_class_vars(self::class))) {
                    $this->$key = $v;
                }
            }
        }
    }
}
