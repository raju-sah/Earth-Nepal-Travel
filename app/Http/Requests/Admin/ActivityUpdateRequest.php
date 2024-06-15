<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ActivityUpdateRequest extends FormRequest
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
            'slug' => "required|string|unique:activities,slug,{$this->activity->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'description' => 'nullable|string|min:5',
            'gallery_caption' => 'nullable|string|max:255',
            'images' => 'nullable',
            'images.*' => 'image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'status' => 'boolean',
            'is_exclusive' => 'boolean',
            'parent_id' => 'nullable|numeric|exists:activities,id',
            'is_parent' => 'nullable',
        ];
    }
}
