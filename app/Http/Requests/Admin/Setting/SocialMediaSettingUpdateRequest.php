<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaSettingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes',
            'slug' => "required|string|unique:social_media_settings,slug,{$this->social_media_setting->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'social_icon' => 'sometimes|image|mimes:png,jpg,jpeg,svg|max:2048',
            'social_link'=>'required',
        ];
    }
}
