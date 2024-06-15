<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'nullable',
            'phone' => 'nullable',
            'contact_address' => 'nullable',
            'working_hours' => 'nullable',
            'copyright_text' => 'nullable',
            'map_url' => 'nullable',
            'primary1_color' => 'nullable',
            'secondary1_color' => 'nullable',
            'primary2_color' => 'nullable',
            'secondary2_color' => 'nullable',
        ];
    }
}
