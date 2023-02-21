<?php

namespace App\Http\Livewire\Components\Inputs;

use Livewire\Component;

class Select2 extends Component
{
    protected $selectedData;
    protected array $data;
    private bool $isAjax = false;
    private bool $isMultiple = false;
    private bool $isCustomTemp = false;
    private string $url = '';
    private string $name = '';

    public function mount(
        $selectedData,
        array $data = [],
        bool $isAjax = false,
        string $url = '',
        bool $isMultiple = false,
        string $name = '',
        bool $isCustomTemp = false,
        string $label = ''
    ): void {
        $this->data = $data;
        $this->isAjax = $isAjax;
        $this->url = $url;
        $this->isMultiple = $isMultiple;
        $this->name = $name;
        $this->selectedData = $selectedData;
        $this->isCustomTemp = $isCustomTemp;
        $this->label = $label;
    }

    public function render()
    {
        return view('livewire.components.inputs.select2', [
            'data' => $this->data,
            'selectedData' => $this->selectedData,
            'isAjax' => $this->isAjax,
            'isMultiple' => $this->isMultiple,
            'isCustomTemp' => $this->isCustomTemp,
            'url' => $this->url,
            'name' => $this->name,
            'label' => $this->label,
        ]);
    }
}

