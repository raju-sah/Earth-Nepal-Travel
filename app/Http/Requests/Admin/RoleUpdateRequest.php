<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'slug' => "required|string|unique:roles,slug,{$this->role->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'permissions' => 'required|array',
            'permissions.*' => 'integer',
        ];
    }
}
