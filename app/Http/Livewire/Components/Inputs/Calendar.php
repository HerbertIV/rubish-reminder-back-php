<?php
declare(strict_types = 1);

namespace App\Http\Livewire\Components\Inputs;

use Livewire\Component;

class Calendar extends Component
{
    public array $events = [];

    public bool $createModal = false;
    public bool $dropModal = false;
    public string $title = '';
    public string $startDate = '';
    public string $endDate = '';
    public string $description = '';
    public $eventId = null;
    public string $formTemplate = '';
    public array $properties = [];
    public string $action;

    protected $rules = [
        'title' => 'required|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after:startDate',
        'description' => 'nullable|string',
    ];

    protected $listeners = [
        'showCreateModal' => 'showCreateModal',
        'showDropEventModal' => 'showDropEventModal',
    ];

    public function mount(
        string $formTemplate
    ) {
        $this->formTemplate = $formTemplate;
        $this->events = [];
    }

    public function render()
    {
        return view('livewire.components.inputs.calendar');
    }

    public function loadEvents(string $start, string $end): array
    {
        $events = collect();
        return $events->toArray();
    }

    public function showCreateModal($date)
    {
        $this->resetValidation();
        $this->createModal = true;
        $this->startDate = $date;
        $this->endDate = $date;
    }

    public function showDropEventModal($id)
    {
        $this->dropModal = true;
        $this->eventId = $id;
    }

    public function closeModal()
    {
        $this->createModal = false;
        $this->dropModal = false;
        $this->resetValidation();
    }

    public function createEvent()
    {
        //
    }

    public function dropEvent()
    {
        //
    }

    public function getPreviewDate()
    {
        return implode(',', [$this->startDate, $this->endDate]);
    }
}

