<?php

namespace App\Http\Requests\Admin;

use App\Enums\PartnerType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PartnerUpdateRequest extends FormRequest
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
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'description' => 'nullable|string',
            'type' => ['required', new Enum(PartnerType::class)],
            'status' => 'boolean',
        ];
    }
}
