<?php

namespace App\Imports;

use App\Enums\DurationType;
use App\Enums\PackageHighlightType;
use App\Models\Activity;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Season;
use App\Models\Service;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

class PackageImport implements
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

        $season_titles = explode(',', $row['best_seasons']);
        $season_ids = Season::whereIn('title', array_map('ucwords', $season_titles))
            ->orWhere(function ($query) use ($season_titles) {
                foreach ($season_titles as $title) {
                    $query->orWhere('title', 'like', '%' . ucwords(trim($title)) . '%');
                }
            })
            ->pluck('id')
            ->toArray();

        $activity_titles = explode(',', $row['activities']);
        $activity_ids = Activity::whereIn('title', array_map('ucwords', $activity_titles))
            ->orWhere(function ($query) use ($activity_titles) {
                foreach ($activity_titles as $title) {
                    $query->orWhere('title', 'like', '%' . ucwords(trim($title)) . '%');
                }
            })
            ->pluck('id')
            ->toArray();

        $destination_titles = explode(',', $row['destinations']);
        $destination_ids = Destination::whereIn('title', array_map('ucwords', $destination_titles))
            ->orWhere(function ($query) use ($destination_titles) {
                foreach ($destination_titles as $title) {
                    $query->orWhere('title', 'like', '%' . ucwords(trim($title)) . '%');
                }
            })
            ->pluck('id')
            ->toArray();

        $service_titles = explode(',', $row['services']);
        $service_ids = Service::whereIn('title', array_map('ucwords', $service_titles))
            ->orWhere(function ($query) use ($service_titles) {
                foreach ($service_titles as $title) {
                    $query->orWhere('title', 'like', '%' . ucwords(trim($title)) . '%');
                }
            })
            ->pluck('id')
            ->toArray();




        $package =  Package::create([
            'user_id' => auth()->id(),
            'image' => 'default-package-image.jpg',
            'title' => $row['title'],
            'slug' => Str::slug($row['title'], '-') . '-' . uniqid(),
            'duration_type' => $row['duration_type'],
            'duration_value' => $row['total_duration'],
            'difficulty_level' => $row['difficulty_level'],
            'starting_location' => $row['starting_location'],
            'ending_location' => $row['ending_location'],
            'min_age' => $row['min_age'],
            'max_age' => $row['max_age'],
            'max_altitude' => $row['max_altitude'],
            'highlight' => $row['highlight'],
            'iframe' => $row['iframe'],
            'overview' => $row['overview'],
            'difficulty_level_icon' => 'beginner.svg',
            'status' => 1,
        ]);

        $package->seasons()->attach($season_ids);
        $package->activities()->attach($activity_ids);
        $package->destinations()->attach($destination_ids);
        $package->services()->attach($service_ids);
    }


    public function prepareForValidation(array $row, $index): array
    {
        $row['highlight'] = ucfirst(trim($row['highlight']));
        $row['duration_type'] = ucfirst(trim($row['duration_type']));

        return $row;
    }
    public function rules(): array
    {
        return [
            '*.title' => ['required', 'string', 'unique:packages,title', 'min:2'],
            '*.duration_type' => ['required', 'string', new Enum(DurationType::class)],
            '*.total_duration' => ['required', 'integer'],
            '*.difficulty_level' => ['required', 'string', 'min:2'],
            '*.starting_location' => ['required', 'string', 'min:2'],
            '*.ending_location' => ['required', 'string', 'min:2'],
            '*.min_age' => ['required', 'integer'],
            '*.max_age' => ['required', 'integer'],
            '*.best_seasons' => ['required','string', 'min:2'], Rule::in(Season::pluck('title')->toArray()),
            '*.max_altitude' => ['numeric'],
            '*.highlight' => ['string', new Enum(PackageHighlightType::class)],
            '*.activities' => ['required','string', 'min:2'], Rule::in(Activity::pluck('title')->toArray()),
            '*.destinations' => ['required','string', 'min:2'], Rule::in(Destination::pluck('title')->toArray()),
            '*.iframe' => ['string', 'min:2'],
            '*.services' => ['required','string', 'min:2'], Rule::in(Service::pluck('title')->toArray()),
            '*.overview' => ['required','string', 'min:2'],
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
