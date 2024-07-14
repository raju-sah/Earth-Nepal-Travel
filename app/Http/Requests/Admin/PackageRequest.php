<?php

namespace App\Http\Requests\Admin;

use App\Enums\DifficultyLevelType;
use App\Enums\DurationType;
use App\Enums\PackageHighlightType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');
        return [
            'image' => 'required|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'title' => 'required|string|max:255',
            'slug' => "required|string|unique:packages,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'duration_type' =>  ['required', 'string', new Enum(DurationType::class)],
            'duration_value' => 'required|integer',
            'difficulty_level' => ['required', 'string', new Enum(DifficultyLevelType::class)],
            'difficulty_level_icon' => 'required|string',
            'min_age' => 'required|integer',
            'max_age' => 'required|integer',
            'overview' => 'required|string',
            'starting_location' => 'required|string',
            'ending_location' => 'required|string',
            'max_altitude' => 'nullable|integer',
            'road_map' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'iframe' => 'nullable|string',
            'status' => 'boolean',
            'view_count' => 'nullable',
            'price' => 'nullable',
            'highlight' => ['nullable', 'string', new Enum(PackageHighlightType::class)],
            'seasons' => 'required|array',
            'seasons.*' => 'integer',
            'activities' => 'required|array',
            'activities.*' => 'integer',
            'destinations' => 'required|array',
            'destinations.*' => 'integer',
            'services' => 'required|array',
            'services.*' => 'integer',
            'journey_type' => 'nullable|string',
            'journey_type_childs' => 'nullable|required_with:journey_type|array',
            'journey_type_childs.*' => 'integer',
        ];
    }
}
