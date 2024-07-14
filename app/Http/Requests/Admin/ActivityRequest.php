<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');
        return [
            'title' => 'required|string|max:255',
            'slug' => "required|string|unique:activities,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'description' => 'nullable|string|min:5',
            'gallery_caption' => 'nullable|string|max:255',
            'status' => 'boolean',
            'is_exclusive' => 'boolean',
            'images' => 'required',
            'images.*' => 'image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'parent_id' => 'nullable|numeric|exists:activities,id',
        ];
    }
}
