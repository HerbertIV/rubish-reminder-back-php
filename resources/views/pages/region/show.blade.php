<x-app-layout>
    <x-slot name="header_content">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Region') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">

            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <a class="btn btn-info text-sm text-white-600 hover:text-white-900" href="{{ route('regions.index') }}">
                    {{ __('Back') }}
                </a>
                <a class="btn btn-info text-sm text-white-600 hover:text-white-900" href="{{ route('regions.edit', $region) }}">
                    {{ __('Edit') }}
                </a>
            </div>

            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Name') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <strong>{{ $region->name }}</strong>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Parent') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if ($region->parent)
                                <a class="font-weight-600" href="{{ route('regions.show', $region->parent) }}">{{ $region->parent->name }}</a>
                            @else
                                ---
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

    </div>

</x-app-layout>

