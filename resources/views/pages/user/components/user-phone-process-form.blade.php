<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Verify phone process') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Form to verying phone code') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="firstName" value="{{ __('Sms code') }}" />
                <small>{{ __('Sms code') }}</small>
                <x-jet-input
                    id="smsCode"
                    type="text"
                    class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="smsCode" />
                <x-jet-input-error for="smsCode" class="mt-2" />
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
