<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/* This trait will be used for generating an empty collection and fill it with data based on interval */

trait EmptyCollectionTrait
{
    public function emptyCollection($_start_date, $_end_date): Collection
    {
        $end_date = Carbon::parse($_end_date);
        $start_date = Carbon::parse($_start_date);

        if ($end_date->gt(Carbon::now()->endOfDay())) {
            $end_date = Carbon::now()->endOfDay();
        }

        $empty_collection = collect();

        $date_difference = $start_date->diffInDays($end_date);

        //Populate empty collection with dates from provided interval
        for ($i = 0; $i <= $date_difference; $i++) {
            $date = $end_date->copy()->subDays($i)->format('Y-m-d');
            $empty_collection->push([
                'x' => $date,
                'y' => 0
            ]);
        }

        //Set keys of empty_collection to the value of day (For merging)
        return $empty_collection->keyBy('x');
    }
}

