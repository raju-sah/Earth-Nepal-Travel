<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookingFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        return view('front.pages.booking_form');
    }
    public function store(BookingFormRequest $request): RedirectResponse
    {
        return back()->with('success', 'Booking Created Successfully!');
    }
}
