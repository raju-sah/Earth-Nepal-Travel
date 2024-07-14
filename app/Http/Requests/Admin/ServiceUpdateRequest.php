<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');
        return [
            'title' => 'required|string',
            'slug' => "required|string|unique:services,slug,{$this->service->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'type' => 'nullable|string',
            'rate_type' => 'nullable|string',
            'price' => 'nullable|numeric',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ];
    }
}
