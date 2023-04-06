<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Phone process verify') }}</h1>
    </x-slot>

    <div>
        <livewire:user-phone-process-form action="userPhoneProcessVerify" token="{{ $token }}"/>
    </div>
</x-app-layout>
