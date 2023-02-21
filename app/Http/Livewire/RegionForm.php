<?php

namespace App\Http\Livewire;

use App\Http\Requests\RegionCreateRequest;
use App\Models\Region;
use Livewire\Component;

class RegionForm extends Component
{
    public string $name;
    public ?int $parentId = null;
    public string $action;
    public array $button;

    protected function getRules()
    {
        return (new RegionCreateRequest)->rules();
    }

    public function createRegion()
    {
        $this->resetErrorBag();
        $this->validate();

        dd('s');
        User::create($this->user);

        $this->emit('saved');
        $this->reset('user');
    }

    public function updateRegion()
    {
        dd('update');
        $this->resetErrorBag();
        $this->validate();

        User::query()
            ->where('id', $this->userId)
            ->update([
                "name" => $this->user->name,
                "email" => $this->user->email,
            ]);

        $this->emit('saved');
    }

    public function mount()
    {
//        if (!$this->region && $this->regionId) {
//            $this->region = Region::find($this->regionId);
//        }
        $this->button = create_button($this->action, 'Region');
    }

    public function render()
    {
        return view('livewire.region-form');
    }
}
