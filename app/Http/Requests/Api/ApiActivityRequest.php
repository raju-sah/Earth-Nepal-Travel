<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ApiActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'is_exclusive' => 'nullable|in:Yes,No',
            'per_page' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'is_exclusive.in' => 'Please enter a valid value for is_exclusive: Yes or No.',
        ];
    }
}
