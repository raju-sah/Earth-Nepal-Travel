<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageFaqCommonFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'common_faqs' => 'required|array',
            'common_faqs.*' => 'integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'common_faqs.*' => 'Common Faq',
        ];
    }
}
