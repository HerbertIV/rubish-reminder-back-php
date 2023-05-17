<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Region') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('regions.index') }}">{{ __('Regions') }}</a></div>
            <div class="breadcrumb-item">Region</div>
        </div>
    </x-slot>

    <div class="card-body">
        <ul class="nav nav-tabs" id="tab-header" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" id="form-tab" data-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="true">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="schedules" data-toggle="tab" href="#schedules-content" role="tab" aria-controls="schedules-content" aria-selected="false">Schedules</a>
            </li>
        </ul>
        <div class="tab-content tab-bordered" id="tab-content">
            <div class="tab-pane fade active show" id="form" role="tabpanel" aria-labelledby="form">
                <livewire:region-form action="updateRegion" :region="$region"/>
            </div>
            <div class="tab-pane fade" id="schedules-content" role="tabpanel" aria-labelledby="schedules">
                <livewire:schedule-calendar
                    action="createEvent"
                    :placeables="[\App\Models\Region::class => [$region->getKey()]]"
                    formTemplate="pages.schedule.components.modal-form"/>
            </div>
        </div>
    </div>
</x-app-layout>
