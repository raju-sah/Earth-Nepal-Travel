<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DestinationCategoryUpdateRequest extends FormRequest
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
            'slug' => "required|string|unique:destination_categories,slug,{$this->destination_category->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'description' => 'nullable|string|min:5',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'image_caption' => 'nullable|string',
            'status' => 'boolean',
            'parent_id' => 'nullable|numeric|exists:destination_categories,id',
        ];
    }
}
