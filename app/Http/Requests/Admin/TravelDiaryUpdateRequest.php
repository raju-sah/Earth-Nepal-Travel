<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class TravelDiaryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');
        return [
            'title'=>'required|string',
            'images' => 'required',
            'images.*' => 'image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            ];
    }
}
