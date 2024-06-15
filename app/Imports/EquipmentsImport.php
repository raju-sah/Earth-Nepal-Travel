<?php

namespace App\Imports;

use App\Models\Equipment;
use App\Models\Icon;
use App\Models\Package;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class EquipmentsImport implements
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
        $package_id = Package::where('slug', ucwords($row['package_slug']))
            ->orWhere('slug', 'like', '%' . ucwords($row['package_slug']) . '%')
            ->value('id');

        return new Equipment([
            'title' => $row['title'],
            'icon' => 'bags.svg',
            'description' => $row['description'],
            'package_id' => $package_id,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.title' => ['required', 'string', 'min:2'],
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
