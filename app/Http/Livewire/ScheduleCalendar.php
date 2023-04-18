<?php

namespace App\Http\Livewire;

use App\Dtos\ScheduleDto;
use App\Http\Livewire\Components\Inputs\Calendar;
use App\Http\Requests\ScheduleRequest;
use App\Services\Contracts\ScheduleServiceContract;
use Illuminate\Support\Carbon;

class ScheduleCalendar extends Calendar
{
    private ScheduleServiceContract $scheduleService;
    protected $listeners = [
        'showCreateModal' => 'showCreateModal',
        'showDropEventModal' => 'showDropEventModal',
        'selectedCompanyItem',
    ];
    public $selectedState = false;

    public function __construct($id = null)
    {
        $this->scheduleService = app(ScheduleServiceContract::class);
        parent::__construct($id);
    }

    public function selectedCompanyItem($name, $item)
    {
        $this->$name = preg_match('/^\d+$/', $item) ? (int)$item : $item;
        if ($name === 'properties.placeableType') {
            $this->selectedState = preg_match('/^\d+$/', $item) ? (int)$item : $item;
        }
    }

    public function createEvent()
    {
        $this->resetErrorBag();
        $this->validate();

        $scheduleDto = new ScheduleDto($this->toArray());
        $schedule = $this->scheduleService->create($scheduleDto);

        $this->closeModal();
        if ($schedule) {
            $this->emit('createdEvent', [
                'title' => $schedule->garbage_type . ' - ' . $schedule->placeable->name,
                'start' => Carbon::make($schedule->execute_datetime)->format('Y-m-d'),
                'id' => $schedule->getKey()
            ]);
        }
        $this->emit('refreshFullCalendar');
    }

    public function dropEvent()
    {
        if ($this->scheduleService->delete($this->eventId)) {
            $this->closeModal();
            $this->emit('deletedEvent', [
                'id' => $this->eventId
            ]);
        }
        $this->emit('refreshFullCalendar');
    }

    public function toArray()
    {
        return [
            'placeable_id' => $this->properties['placeableId'] ?? null,
            'placeable_type' => $this->properties['placeableType'] ?? null,
            'garbage_type' => $this->properties['garbageType'] ?? null,
            'execute_datetime' => $this->startDate ?? null,
        ];
    }

    public function loadEvents(string $start, string $end): array
    {
        return $this->scheduleService->getEvents($start, $end);
    }

    public function render()
    {
        $this->events = $this->loadEvents(
            Carbon::now()->firstOfYear()->format('Y-m-d'),
            Carbon::now()->lastOfYear()->format('Y-m-d')
        );
        return parent::render();
    }

    protected function getRules()
    {
        return (new ScheduleRequest)->rules();
    }
}

