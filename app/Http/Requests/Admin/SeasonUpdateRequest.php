<?php

namespace App\Http\Requests\Admin;

use App\Enums\MonthType;
use App\Enums\SeasonType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SeasonUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'type' => ['required', 'string', new Enum(SeasonType::class)],
            'starting_month' => ['required', 'string', new Enum(MonthType::class)],
            'ending_month' => ['required', 'string', new Enum(MonthType::class)],
            'status' => 'boolean',
        ];
    }
}
