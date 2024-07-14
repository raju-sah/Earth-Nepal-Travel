<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class IconRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');
        return [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
        ];
    }
}
