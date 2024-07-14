<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{

    public function show($slug)
    {
        $destinationDetails = Destination::whereNull('parent_id')->where('slug', $slug)->active()->first();
        $relatedPackages = $destinationDetails->packages()->active()->select('title', 'slug', 'image', 'price', 'overview')->withAvgRating()->take(10)->get();
        $otherDestinations = Destination::whereNull('parent_id')
            ->where('slug', '!=', $slug)
            ->active()
            ->select('title', 'slug', 'image')
            ->take(10)
            ->latest()
            ->get();
        return view('front.pages.destinations.destination_detail', [
            'destinationDetails' => $destinationDetails,
            'relatedPackages' => $relatedPackages,
            'otherDestinations' => $otherDestinations

        ]);
    }
}
