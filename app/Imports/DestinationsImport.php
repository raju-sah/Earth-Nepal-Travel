<?php

namespace App\Imports;

use App\Models\Destination;
use App\Models\DestinationCategory;
use Database\Seeders\DestinationSeeder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DestinationsImport implements
    ToModel,
    WithHeadingRow,
    WithBatchInserts,
    WithChunkReading,
    WithValidation
{

    public function model(array $row)
    {
        $destination_category_id = DestinationCategory::where('title', ucwords($row['destination_category']))
            ->orWhere('title', 'like', '%' . ucwords($row['destination_category']) . '%')
            ->value('id');

        $destination_parent_id = Destination::where('title', ucwords($row['parent_destination']))
            ->orWhere('title', 'like', '%' . ucwords($row['parent_destination']) . '%')
            ->value('id');

        return new Destination([
            'title' => $row['title'],
            'slug' => Str::slug($row['title'], '-') . '-' . uniqid(),
            'description' => $row['description'],
            'image_caption' => $row['image_caption'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'is_featured' => $row['is_featured'],
            'country' => $row['country'],
            'parent_id' => $destination_parent_id,
            'destination_category_id' => $destination_category_id,
            'status' => 1,


        ]);
    }

    public function rules(): array
    {
        return [
            '*.title' => ['required', 'string', 'unique:destinations,title', 'min:2'],
            '*.description' => ['string', 'min:2'],
            '*.image_caption' => ['string', 'min:2'],
            '*.latitude' => ['numeric', 'min:2'],
            '*.longitude' => ['numeric', 'min:2'],
            '*.is_featured' => ['boolean'],
            '*.country' => ['required', 'string', 'min:2'],
            '*.parent_destination' => ['string', 'min:2'], Rule::in(Destination::pluck('title')->toArray()),
            '*.destination_category' => ['required', 'string', 'min:2 ', Rule::in(DestinationCategory::pluck('title')->toArray())],
        ];
    }

    public function batchSize(): int
    {
        return 10;
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
