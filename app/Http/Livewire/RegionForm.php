<?php

declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Dtos\RegionDto;
use App\Http\Requests\RegionRequest;
use App\Http\Resources\AsyncResource;
use App\Models\Region;
use App\Services\Contracts\RegionServiceContract;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class RegionForm extends Component
{
    private RegionServiceContract $regionService;
    public ?string $name = '';
    public ?int $parentId = null;
    public Region $region;
    public string $action;
    public array $button;

    public function __construct($id = null)
    {
        $this->regionService = app(RegionServiceContract::class);
        parent::__construct($id);
    }

    protected $listeners = [
        'selectedCompanyItem',
        'RegionCreateEvent'
    ];

    public function selectedCompanyItem($name, $item)
    {
        $this->$name = (int)$item;
    }

    protected function getRules()
    {
        return (new RegionRequest)->rules();
    }

    public function createRegion(): void
    {
        $this->resetErrorBag();
        $this->validate();

        $regionDto = new RegionDto($this->toArray());
        $region = $this->regionService->create($regionDto);

        $this->emit('saved');
        $this->redirect(route('regions.show', $region));
    }

    public function updateRegion(): void
    {
        $this->resetErrorBag();
        $this->validate();
        $region = $this->region;
        $regionDto = new RegionDto($this->toArray());
        $this->regionService->update($regionDto, $region->getKey());
        $this->emit('updated');
        $this->redirect(route('regions.show', $region));
    }

    public function mount(?Region $region = null): void
    {
        if ($region) {
            $this->region = $region;
            $this->setData([
                'name' => $this->region->name,
                'parent_id' => $this->region->parent_id,
            ]);
        }
        $this->button = create_button($this->action, 'Region');
    }

    public function render(): View
    {
        return view('pages.region.components.region-form');
    }

    public function getParentIdSelect2Format(): ?array
    {
        if ($this->parentId) {
            return AsyncResource::make($this->regionService->first($this->parentId))->resolve();
        }
        return null;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parent_id' => $this->parentId ?? null
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
