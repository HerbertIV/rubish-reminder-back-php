<?php

namespace App\Http\Requests;

use App\Enums\GarbageTypeEnums;
use BenSampo\Enum\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'properties' => ['array'],
            'properties.placeableId' => ['required', 'int'],
            'properties.garbageType' => ['required', 'string', Rule::in(GarbageTypeEnums::getValues())],
            'startDate' => ['required', 'date'],
        ];
    }
}
