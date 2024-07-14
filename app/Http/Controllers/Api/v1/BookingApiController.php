<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookingStorePackageRequest;
use App\Models\Booking;
use App\Models\Package;

class BookingApiController extends Controller
{
    public function store(BookingStorePackageRequest $request)
    {
        $data = $request->safe()->except(['package_id']);
        if ($request->package_id) {
            $data['bookable_id'] = $request->package_id;
            $data['bookable_type'] = Package::class;
        }
       
        $booking = Booking::create($data);
        return response()->json($booking, 201);
    }
}
