<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');
        return [
            'user_id' => 'sometimes|exists:users,id',
            'title' => 'required|string',
            'slug' => "required|string|unique:blogs,slug,{$this->blog->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'status' => 'boolean',
            'is_popular' => 'boolean',
        ];
    }
}
