<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
          'title' => 'required|string',
          'icon' => 'required|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ];
    }

}
