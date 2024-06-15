<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DestinationUpdateRequest extends FormRequest
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
            'slug' => "required|string|unique:destinations,slug,{$this->destination->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'description' => 'nullable|string|min:5',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'image_caption' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'country' => 'required|string',
            'parent_id' => 'nullable|numeric|exists:destinations,id',
            'destination_category_id' => 'required|numeric|exists:destination_categories,id',
            'activities' => 'required|array',
            'activities.*' => 'integer',
        ];
    }
}
