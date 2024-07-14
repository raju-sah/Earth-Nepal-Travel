<?php

namespace App\Http\Requests\Api;

use App\Enums\InquiryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class InquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', new Enum(InquiryType::class)],
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'subject' => 'required|string',
            'phone' => 'nullable|numeric',
        ];
    }
}
