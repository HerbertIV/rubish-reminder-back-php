<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Create User') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a></div>
            <div class="breadcrumb-item">User</div>
        </div>
    </x-slot>

    <div>
        <livewire:user-form action="createUser" />
    </div>
</x-app-layout>
