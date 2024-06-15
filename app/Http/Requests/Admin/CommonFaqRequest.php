<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommonFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string|min:5',
            'status' => 'boolean',
        ];
    }
}
