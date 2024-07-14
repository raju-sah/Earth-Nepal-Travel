<?php

namespace App\Http\Controllers\Front;

use App\Enums\ServiceType;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function hotelBooking(): View
    {
        return view('front.pages.services.hotel_booking', [
            'hotels' => Service::select('id',  'title', 'slug', 'image', 'rate_type', 'price', 'location')->where('type', ServiceType::Hotel->value)->active()->take(20)->get(),
        ]);
    }

    public function flightBooking(): View
    {
        return view('front.pages.services.flight', [
            'flights' => Service::select('id',  'title', 'slug', 'image', 'rate_type', 'price', 'location')->where('type', ServiceType::Flight->value)->active()->take(20)->get(),
        ]);
    }

    public function raftingBooking(): View
    {
        return view('front.pages.services.rafting', [
            'raftings' => Service::select('id',  'title', 'slug', 'image', 'rate_type', 'price', 'location')->where('type', ServiceType::Rafting->value)->active()->take(20)->get(),
        ]);
    }
}
