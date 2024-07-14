<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\BookingForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookingFormRequest;
use App\Http\Requests\Admin\BookingFormUpdateRequest;


class BookingFormController extends Controller
{
    public function index(): View
    {
        return view('admin.booking_form.index', [
            'booking_forms' => BookingForm::query()->select(['id', 'page_title', 'banner_image', 'content_title', 'description', 'image'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        $booking_form = BookingForm::first();

        if (!is_null($booking_form)) {
            return view('admin.booking_form.edit', compact('booking_form'));
        }

        return view('admin.booking_form.create');
    }

    public function store(BookingFormRequest $request): RedirectResponse
    {
        $bookingform = BookingForm::create($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $bookingform->storeImage('image', 'bookingform-images', $request->file('image'));
        }
        if ($request->hasFile('banner_image')) {
            $bookingform->storeImage('banner_image', 'bookingform-images', $request->file('banner_image'), 1600, 600);
        }

        return redirect()->route('admin.booking-forms.create')->with('success', 'BookingForm Created Successfully!');
    }

    public function show(BookingForm $booking_form): View
    {
        return view('admin.booking_form.show', compact('booking_form'));
    }

    public function edit(BookingForm $booking_form): View
    {
        return view('admin.booking_form.edit', compact('booking_form'));
    }

    public function update(BookingFormUpdateRequest $request, BookingForm $booking_form): RedirectResponse
    {

        $booking_form->update($request->safe()->except('image', 'banner_image'));

        if ($request->hasFile('image')) {
            $booking_form->updateImage('image', 'bookingform-images', $request->file('image'));
        }
        if ($request->hasFile('banner_image')) {
            $booking_form->updateImage('banner_image', 'bookingform-images', $request->file('banner_image'), 1600, 600);
        }

        return redirect()->route('admin.booking-forms.edit')->with('success', 'BookingForm Updated Successfully!');
    }

    public function destroy(BookingForm $booking_form): RedirectResponse
    {
        if ($booking_form->image) {
            $booking_form->deleteImage('image', 'bookingform-images');
        }
        $booking_form->delete();
        return redirect()->route('admin.booking-forms.index')->with('error', 'BookingForm Deleted Successfully!');
    }
}
