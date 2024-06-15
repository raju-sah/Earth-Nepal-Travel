<?php

namespace App\Imports;

use App\Models\Itinerary;
use App\Models\Package;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ItineraryImport implements
    ToModel,
    WithHeadingRow,
    WithBatchInserts,
    WithChunkReading,
    WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Itinerary([
            'icon' => 'bags.svg',
            'title' => $row['title'],
            'day' => $row['day'],
            'description' => $row['description'],
            'max_altitude' => $row['max_altitude'],
            'meals' => $row['meals'],
            'accommodation' => $row['accommodation'],
            'transportation' => $row['transportation'],
            'package_id' => Package::where('slug', ucwords($row['package_slug']))->first()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.title' => ['required', 'string', 'min:2'],
            '*.day' => ['required', 'integer'],
            '*.max_altitude' => ['numeric', 'min:2'],
            '*.meals' => ['string', 'min:2'],
            '*.accommodation' => ['string', 'min:2'],
            '*.transportation' => ['string', 'min:2'],
            '*.description' => ['string', 'min:2'],
            '*.package_slug' => ['required', 'string', Rule::exists('packages', 'slug')],
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
