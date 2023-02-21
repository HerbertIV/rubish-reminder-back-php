<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Region') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Form to create or change Region record') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <small>Region name</small>
                <x-jet-input id="name" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <livewire:components.inputs.select2
                :selectedData="[]"
                isAjax="true"
                label="Regions list"
                url="{{ route('async.regions') }}"
                name="parent_id" />
            @error('files') <span class="text-red-600">{{ $message }}</span> @enderror
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
