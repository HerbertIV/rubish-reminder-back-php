<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:110'],
            'firstName' => ['nullable', 'string', 'max:125'],
            'lastName' => ['nullable', 'string', 'max:125'],
            'phone' => ['nullable', 'string', 'max:20'],
            'active' => ['boolean'],
            'regionId' => ['nullable', 'integer', 'exists:regions,id'],
        ];
    }
}
