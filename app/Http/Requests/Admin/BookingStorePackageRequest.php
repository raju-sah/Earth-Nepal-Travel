<?php

namespace App\Http\Requests\Admin;

use App\Enums\BookingType;
use App\Enums\StatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BookingStorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string'],
            'phone' => ['required', 'string'],
            'arrival_date' => ['nullable', 'date'],
            'return_date' => ['nullable', 'date'],
            'no_of_adults' => ['nullable', 'integer', 'required_with:no_of_child,no_of_infant'],
            'no_of_child' => ['nullable', 'integer',],
            'no_of_infant' => ['nullable', 'integer',],
            'address' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'type' => ['nullable', 'string', new Enum(BookingType::class)],
            'message' => ['nullable', 'string'],
            'package_id' => ['nullable',], // changes based on booking type
        ];
    }
}
