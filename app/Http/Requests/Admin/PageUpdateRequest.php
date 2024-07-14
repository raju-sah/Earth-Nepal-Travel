<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
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
            'slug' => "required|string|unique:pages,slug,{$this->page->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'banner_image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'description' => 'nullable|string',
            'status' => 'boolean',
        ];
    }
}
