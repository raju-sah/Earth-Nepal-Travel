<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'subject' => 'required|string',
            'body' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'template name',
            'subject' => 'email subject',
            'body' => 'email body',
        ];
    }
}
