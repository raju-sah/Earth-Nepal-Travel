<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ItineraryDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'icon' => 'required|string',
            'duration_value' => 'required|integer',
            'duration_unit' => 'required|string',
            'itinerary_id' => 'required|integer|exists:itineraries,id',
            'description' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'itinerary_id' => 'Itinerary',
        ];
    }
}
