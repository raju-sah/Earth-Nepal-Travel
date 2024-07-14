<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'image' => 'required|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'designation' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'team_type' => 'required',
            'social_link.*' => 'nullable|array',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'full name',
            'image' => 'user avatar',
        ];
    }
}
