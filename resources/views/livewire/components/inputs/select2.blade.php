<div class="form-group {{ $isMultiple ? 'multi' : 'single' }} col-span-6 sm:col-span-5" data-error-border="{{ $name }}">
    <label>{{ $label }}</label>
    <select id="{{ $name }}"
            @if ($isMultiple)
            name="{{ $name }}[]"
            multiple=""
            @else
            name="{{ $name }}"
            @endif
            @if ($isAjax)
            data-ajax-select2
            data-ajax-select2-url="{{ $url }}"
            @endif
            @if ($isCustomTemp)
            data-custom-temp="true"
            data-selected-items="{{ $selectedData }}"
            @endif
            class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                                    focus:ring-opacity-50 rounded-md shadow-sm w-full select2
            "
            data-searching-text="{{ __('search.search_in_progress') }}"
            data-no-result-found-text="{{ __('search.not_result_found') }}"
    >
        @if (!$isAjax)
            <option value="">{{ __('action.select') }}</option>
            @foreach($data as $item)
                <option value="{{ $item['id'] }}" {{ isset($selectedData[$item['id']]) ? 'selected' : '' }}>
                    {{ $item['name'] ?? '' }}
                </option>
            @endforeach
        @else
            @if (!$isCustomTemp)
                @foreach($selectedData as $item)
                    <option selected value="{{ $item['id'] }}">
                        @if(isset($item['name']) && $item['name'])
                            {{ $item['name'] }}
                        @else
                            {{ $item['title'] ?? '' }}
                        @endif
                    </option>
                @endforeach
            @endif
        @endif
    </select>
    @if ($isMultiple)
        <div class="arrow-right" data-arrow-select2>
            <div class="arrow-mask"></div>
        </div>
    @else
        <div class="clear-select2" data-select2-clear>
            <span>X</span>
        </div>
    @endif
</div>
