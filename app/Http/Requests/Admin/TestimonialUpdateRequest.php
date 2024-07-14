<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialUpdateRequest extends FormRequest
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
            'email' => 'required|email',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'designation' => 'required|string',
            'rating' => 'nullable|numeric',
            'status' => 'boolean',
        ];
    }
}
