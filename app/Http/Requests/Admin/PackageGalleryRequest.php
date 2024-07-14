<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageGalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');
        return [
            'images' => 'required',
            'images.*' => 'image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
        ];
    }
}
