<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'slug' => "required|string|unique:permissions,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
        ];
    }
}
