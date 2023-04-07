<x-app-layout>
    <x-slot name="header_content">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedules') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="fc-overflow">
                        <livewire:components.inputs.calendar />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
