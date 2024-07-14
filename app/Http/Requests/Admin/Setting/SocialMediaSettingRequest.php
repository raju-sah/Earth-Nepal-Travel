<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;


class SocialMediaSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'=>'sometimes',
            'slug' => "required|string|unique:social_media_settings,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'social_icon' => 'sometimes|image|mimes:png,jpg,jpeg,svg|max:2048',
            'social_link'=>'required',
            ];
    }
}
