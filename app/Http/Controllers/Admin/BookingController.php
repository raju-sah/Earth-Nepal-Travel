<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookingStorePackageRequest;
use App\Mail\BookingMail;
use App\Models\Booking;
use App\Models\EmailTemplate;
use App\Models\Package;
use App\Models\SiteSetting;
use App\Models\User;
use App\Notifications\BookingNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        return view('admin.booking.index', [
            'bookings' => Booking::select(['id', 'name', 'email', 'phone', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.booking.create');
    }

    public function store(BookingStorePackageRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $booking = Booking::create($request->safe()->except(['hotel_data', 'package_id']));

            if ($request->has('hotel_name')) {
                $booking->additional_data = ['hotel_name' => $request->hotel_name, 'package_id' => $request->package_id];
            }

            if ($request->package_id) {
                $booking->bookable_id = $request->package_id;
                $booking->bookable_type = Package::class;
            }

            $booking->save();

            $this->sendNotifications($booking);

            DB::commit();
            return redirect()->route('admin.bookings.index')->with('success', 'Booking Created Successfully!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function show(Booking $booking): View
    {
        return view('admin.booking.show', compact('booking'));
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        $this->deleteNotification($booking);

        return redirect()->route('admin.bookings.index')->with('error', 'Booking Deleted Successfully!');
    }

    public function updateStatus(Request $request): JsonResponse
    {
        Booking::find($request->id)?->update(['status' => $request->status,]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function bookingNotification(Booking $booking)
    {
        return view('admin.booking.notification', [
            'booking' => $booking,
            'templates' => EmailTemplate::pluck('name', 'id'),
        ]);
    }

    private function sendNotifications(Booking $booking): void
    {
        $siteSetting = SiteSetting::first();
        $users = User::where('user_type', UserType::Admin->value)->get();

        Mail::to($siteSetting->email)->send(new BookingMail($booking, $siteSetting));
        Notification::send($users, new BookingNotification($booking));
    }

    private function deleteNotification(Booking $booking): void
    {
        DB::table('notifications')
            ->where('type', BookingNotification::class)
            ->whereJsonContains('data->booking->id', $booking->id)
            ->delete();
    }
}
