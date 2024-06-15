<?php

namespace App\Http\Requests\Admin;

use App\Enums\MenuType;
use Illuminate\Foundation\Http\FormRequest;

class MenuUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'classes' => 'nullable|string',
            'order' => 'required|numeric',
            'target' => 'nullable|string',
            'parent_id' => 'nullable|numeric|exists:menus,id',
            'menuable_id' => 'required_unless:menu_type,'.MenuType::Custom->value.','.MenuType::Default->value,
            'menu_type' => ['nullable', 'required_with:parent_id'],
            'url' => 'required_if:menu_type,'.MenuType::Custom->value,
            'is_clickable' => 'boolean',
        ];
    }
}
