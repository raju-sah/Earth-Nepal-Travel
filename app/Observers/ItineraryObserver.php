<?php

namespace App\Observers;

use App\Models\Itinerary;

class ItineraryObserver
{
    public function created(Itinerary $itinerary): void
    {
        $itinerary->order = Itinerary::where('package_id', $itinerary->package_id)->max('order') + 1;
        $itinerary->save();
    }

    public function deleted(Itinerary $itinerary): void
    {
        $lowerPriorityItineraries = Itinerary::select(['id', 'order'])
            ->where('order', '>', $itinerary->order)
            ->where('package_id', $itinerary->package_id)
            ->get();

        foreach ($lowerPriorityItineraries as $lowerPriorityItinerary) {
            $lowerPriorityItinerary->order--;
            $lowerPriorityItinerary->saveQuietly();
        }
    }
}
