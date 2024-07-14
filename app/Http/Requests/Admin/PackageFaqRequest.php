<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'question' => 'required|string',
            'answer' => 'required|string',
            'status' => 'boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'question' => 'Question',
            'answer' => 'Answer',
            'status' => 'Status',
        ];
    }
}
