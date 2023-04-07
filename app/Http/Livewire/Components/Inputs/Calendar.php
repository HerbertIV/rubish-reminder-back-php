<?php

namespace App\Http\Livewire\Components\Inputs;

use Livewire\Component;

class Calendar extends Component
{
    public $events = [];

    public $createModal = false;
    public $title = '';
    public $start_date = '';
    public $end_date = '';
    public $description = '';

    protected $rules = [
        'title' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'description' => 'nullable',
    ];

    protected $listeners = ['showCreateModal' => 'showCreateModal'];

    public function mount()
    {
        $this->events = [];
    }

    public function render()
    {
        return view('livewire.components.inputs.calendar');
    }

    public function loadEvents($start, $end)
    {
        $events = collect();
        $this->events = $events->toArray();
    }

    public function showCreateModal($date)
    {
        $this->resetValidation();
        $this->createModal = true;
        $this->start_date = $date;
        $this->end_date = $date;
    }

    public function hideCreateModal()
    {
        $this->createModal = false;
        $this->resetValidation();
    }

    public function createEvent()
    {
        dd('sss');
    }
}

