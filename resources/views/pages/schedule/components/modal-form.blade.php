<div id="form-create">
    @if (!$this->placeables)
        <div class="form-group col-span-12 sm:col-span-12">
            <livewire:components.inputs.select2
                :selectedData="[]"
                isAjax="true"
                label="{{ __('Region types') }}"
                url="{{ route('async.region-types') }}"
                name="properties.placeableType" />
            @error('properties.placeableType') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
    @endif
    @if (($this->selectedState ?? false) && !$this->placeables)
        @switch($this->selectedState)
            @case (\App\Enums\RegionTypesEnums::REGION_TYPE)
            <div class="form-group col-span-12 sm:col-span-12">
                <livewire:components.inputs.select2
                    :selectedData="[]"
                    isAjax="true"
                    label="{{ __('Regions list') }}"
                    url="{{ route('async.regions') }}"
                    name="properties.placeableId" />
                @error('properties.placeableId') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            @default
        @endswitch
        <div class="form-group col-span-12 sm:col-span-12">
            <livewire:components.inputs.select2
                :selectedData="[]"
                isAjax="true"
                url="{{ route('async.rubbish-type') }}"
                label="{{ __('Garbage types list') }}"
                name="properties.garbageType"
            />
            @error('properties.garbageType') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
    @elseif ($this->placeables)
        <div class="form-group col-span-12 sm:col-span-12">
            <livewire:components.inputs.select2
                :selectedData="[]"
                isAjax="true"
                url="{{ route('async.rubbish-type') }}"
                label="{{ __('Garbage types list') }}"
                name="properties.garbageType"
            />
            @error('properties.garbageType') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
    @endif
</div>
