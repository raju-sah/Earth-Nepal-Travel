<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialApiRequest extends FormRequest
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
            'image' => 'required|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'designation' => 'required|string',
            'rating' => 'nullable|numeric',
            'description' => 'nullable|string',
        ];
    }
}
