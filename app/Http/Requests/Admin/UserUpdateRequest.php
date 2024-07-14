<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => "required|string|email|unique:users,email,{$this->user->id},id",
            'current_password' => 'nullable|string|required_with:new_password|min:8',
            'new_password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'numeric|exists:permissions,id',
            'confirm_password' => 'nullable|string|required_with:new_password|same:new_password',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'status' => 'boolean',
        ];
    }
}
