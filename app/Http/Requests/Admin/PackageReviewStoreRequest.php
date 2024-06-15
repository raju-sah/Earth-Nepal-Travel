<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageReviewStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullname' => 'required|string',
            'email' => 'required|string|email',
            'rating' => 'required|min:1|max:5',
            'review_text' => 'required|string|min:5',
            'package_id' => 'required|integer',
        ];
    }
}
