<?php

namespace App\Observers;

use App\Models\ItineraryDetail;

class ItineraryDetailObserver
{
    public function created(ItineraryDetail $itinerary_detail): void
    {
        $itinerary_detail->order = ItineraryDetail::where('package_id', $itinerary_detail->package_id)->max('order') + 1;
        $itinerary_detail->save();
    }

    public function deleted(ItineraryDetail $itinerary_detail): void
    {
        $lowerPriorityItineraryDetails = ItineraryDetail::select(['id', 'order'])
            ->where('order', '>', $itinerary_detail->order)
            ->where('package_id', $itinerary_detail->package_id)
            ->get();

        foreach ($lowerPriorityItineraryDetails as $lowerPriorityItineraryDetail) {
            $lowerPriorityItineraryDetail->order--;
            $lowerPriorityItineraryDetail->saveQuietly();
        }
    }
}
