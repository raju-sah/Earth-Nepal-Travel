<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ItineraryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'icon' => 'required|string',
            'day' => 'required|integer',
            'description' => 'nullable|string',
            'max_altitude' => 'nullable|string',
            'meals' => 'nullable|string',
            'accommodation' => 'nullable|string',
            'transportation' => 'nullable|string',
        ];
    }
}
