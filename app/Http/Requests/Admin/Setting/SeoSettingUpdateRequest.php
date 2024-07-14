<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SeoSettingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_author' => 'nullable',
            'meta_robots' => 'nullable',
            'meta_description' => 'nullable',
        ];
    }
}
