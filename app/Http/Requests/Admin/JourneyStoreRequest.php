<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JourneyStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');

        return [
            'name' => 'required|string',
            'slug' => "required|string|unique:journeys,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'img' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'type' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ];
    }
}
