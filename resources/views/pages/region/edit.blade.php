<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Region') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('regions.index') }}">{{ __('Regions') }}</a></div>
            <div class="breadcrumb-item">Region</div>
        </div>
    </x-slot>

    <div>
        <livewire:region-form action="updateRegion" :region="$region"/>
    </div>
</x-app-layout>
