<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('User') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Form to create or change User record') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="firstName" value="{{ __('First name') }}" />
                <small>{{ __('First name') }}</small>
                <x-jet-input
                    id="firstName"
                    type="text"
                    class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="firstName" />
                <x-jet-input-error for="firstName" class="mt-2" />
            </div>
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="lastName" value="{{ __('Last name') }}" />
                <small>{{ __('Last name') }}</small>
                <x-jet-input
                    id="lastName"
                    type="text"
                    class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="lastName" />
                <x-jet-input-error for="lastName" class="mt-2" />
            </div>
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <small>{{ __('Email') }}</small>
                <x-jet-input
                    id="email"
                    type="text"
                    class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <small>{{ __('Phone') }}</small>
                <x-jet-input
                    id="phone"
                    type="text"
                    class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="phone" />
                <x-jet-input-error for="phone" class="mt-2" />
            </div>
            <livewire:components.inputs.select2
                :selectedData="[$this->getRegionIdSelect2Format()]"
                isAjax="true"
                label="{{ __('Regions list') }}"
                url="{{ route('async.regions') }}"
                name="regionId" />
            @error('regionId') <span class="text-red-600">{{ $message }}</span> @enderror
            <div class="form-group col-span-6 sm:col-span-5">
                <div class="control-label">{{ __('Active') }}</div>
                <label class="custom-switch mt-2">
                    <input type="checkbox" {{ $this->active ? 'checked' : '' }} data-switcher name="active" class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                </label>
                <x-jet-input-error for="active" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __($button['submit_response']) }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __($button['submit_text']) }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
