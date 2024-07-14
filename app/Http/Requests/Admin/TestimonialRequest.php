<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');

        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'nationality' => 'required|string',
            'designation' => 'nullable|string',
            'rating' => 'nullable',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ];
    }
}
