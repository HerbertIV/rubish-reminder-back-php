<x-app-layout>
    <x-slot name="header_content">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Templates') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            @can('template' . \App\Enums\PermissionEnums::HYPHEN . \App\Enums\PermissionEnums::CREATE_ACTION)
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                    <div class="px-4 py-3 sm:px-6 flex justify-end">
                        <a href="{{ route('templates.create') }}"  class="-ml- btn btn-primary shadow-none">
                            <span class="fas fa-plus"></span> {{ __('Create') }}
                        </a>
                    </div>
                </div>
            @endcan

            <livewire:table.templates />

        </div>
    </div>
</x-app-layout>
